<?php
require_once "database.php";

//------------------------------

class Filesystem {
    // Get directory condition for SQL query
    private static function build_dir_condition(?int $parent_directory_id) {
        return $parent_directory_id
            ? "filesystem_entries.directory_id = $parent_directory_id"
            : "filesystem_entries.directory_id IS NULL";
    }

    // Create new filesystem entry in database
    public static function create_entry(string $name, int $user_id, ?int $parent_directory_id = null, ?int $hidden = 0) {
        return Database::execute("
                INSERT INTO 
                    filesystem_entries(name, directory_id, user_id, hidden)
                VALUES(?, ?, ?, ?)
            ",
            "siii",
            $name,
            $parent_directory_id,
            $user_id,
            $hidden?? 0
        );
    }

    // Create new file in database
    public static function create_file(int $filesystem_entry_id, ?int $lifetime = null) {
        return Database::execute(
            "INSERT INTO files(filesystem_entry_id, lifetime) VALUES(?, ?)",
            "ii", 
            $filesystem_entry_id,
            $lifetime
        );
    }

    // Create new directory in database
    public static function cretate_directory(int $filesystem_entry_id) {
        return Database::execute(
            "INSERT INTO directories(filesystem_entry_id) VALUES(?)", 
            "i", 
            $filesystem_entry_id
        );
    }

    // Check if or directory exists under specified directory by name
    public static function exists(string $name, ?int $parent_directory_id = null) {
        return Database::get_first_row("
                SELECT id 
                FROM filesystem_entries
                WHERE
                    " . self::build_dir_condition($parent_directory_id) . " 
                    AND name = ?
            ",
            "s",
            $name
        ) !== null;
    }

    // Delete filesystem entry
    public static function delete_entry(int $filesystem_entry_id) {
        Database::execute(
            "DELETE FROM filesystem_entries WHERE id = ?",
            "i",
            $filesystem_entry_id
        );
    }

    // Get real file path by id
    public static function get_real_path(int $file_id) {
        return Config::STORAGE_DATA_DIR . $file_id;
    }

    // Delete file (both database and physically)
    public static function delete_file(int $file_id) {
        Database::execute("
                DELETE 
                    filesystem_entries
                FROM 
                    filesystem_entries
                    LEFT JOIN files
                    ON files.filesystem_entry_id = filesystem_entries.id
                WHERE
                    files.id = ?
            ",
            "i",
            $file_id
        );

        unlink(self::get_real_path($file_id));
    }

    // Delete directory and all it's content recursively
    public static function delete_directory(int $directory_id) {
        $files = Database::get_table("
                SELECT 
                    files.id as `id`
                FROM
                    files
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = files.filesystem_entry_id
                WHERE
                    filesystem_entries.directory_id = ?
            ",
            "i",
            $directory_id
        );

        $directories = Database::get_table("
                SELECT 
                    directories.id as `id`
                FROM
                    directories
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = directories.filesystem_entry_id
                WHERE
                    filesystem_entries.directory_id = ?
            ",
            "i",
            $directory_id
        );

        foreach ($files as $file) {
            Filesystem::delete_file($file["id"]);
        }

        foreach ($directories as $directory) {
            self::delete_directory($directory["id"]);
        }

        Database::execute("
                DELETE 
                    filesystem_entries
                FROM
                    directories
                    LEFT JOIN filesystem_entries 
                    ON filesystem_entries.id = directories.filesystem_entry_id
                WHERE
                    directories.id = ?
            ",
            "i",
            $directory_id
        );
    }

    // Convert directory path to directory id ("/govno/pizda/zalupa" => 312)
    public static function resolve_directory_path(string $path, ?int $parent_directory_id = null): ?int {
        $parent_directory_id = null;
        foreach (explode("/", $path) as $directory_name) {
            if (empty($directory_name))
                continue;

            $parent_directory_id = Database::get_first_cell("
                    SELECT 
                        directories.id
                    FROM 
                        directories
                        LEFT JOIN filesystem_entries
                        ON filesystem_entries.id = directories.filesystem_entry_id
                    WHERE 
                        " . self::build_dir_condition($parent_directory_id) . "
                        AND filesystem_entries.name = ?
                ",
                "s",
                $directory_name
            );

            if ($parent_directory_id === null)
                return null;
        }

        return $parent_directory_id;
    }

    // Convert path to file id ("/govno/pizda/zalupa/test.txt" => 123)
    public static function resolve_file_path(string $path, ?int $parent_directory_id = null): ?int {
        $info = pathinfo($path);

        if ($info["dirname"] != ".")
            $parent_directory_id = self::resolve_directory_path($info["dirname"], $parent_directory_id);

        return Database::get_first_cell("
                SELECT files.id
                FROM 
                    files
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = files.filesystem_entry_id
                WHERE
                    " . self::build_dir_condition($parent_directory_id) ."
                    AND filesystem_entries.name = ?
            ",
            "s",
            $info["basename"]
        );
    }

    // Convert directory id to path (321 => "/govno/pizda/zalupa")
    public static function resolve_directory_id(?int $id): string {
        if ($id === null)
            return "";

        $path = "";
        $current_directory_id = $id;
        while ($current_directory_id !== null) {
            $entry = Database::get_first_row("
                    SELECT 
                        filesystem_entries.directory_id as `next_directory_id`,
                        filesystem_entries.name as `name`
                    FROM 
                        directories
                        LEFT JOIN filesystem_entries
                        ON filesystem_entries.id = directories.filesystem_entry_id
                    WHERE 
                        directories.id = ?
                ",
                "i",
                $current_directory_id
            );

            $path = "/$entry[name]" . $path;
            $current_directory_id = $entry["next_directory_id"];
        }

        return $path;
    }

    // Convert file id to path (123 => "/govno/pizda/zalupa/test.txt")
    public static function resolve_file_id(int $id): ?string {
        $file = Database::get_first_row("
                SELECT
                    filesystem_entries.directory_id as `directory_id`,
                    filesystem_entries.name as `name`
                FROM
                    files
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = files.filesystem_entry_id
                WHERE 
                    files.id = ?
            ",
            "i",
            $id
        );

        if (!$file)
            return null;

        return self::resolve_directory_id($file["directory_id"]) . "/" . $file["name"];
    }

    // Get directory owner id
    public static function get_directory_owner(int $directory_id): ?int {
        return Database::get_first_cell("
                SELECT 
                    filesystem_entries.user_id
                FROM 
                    directories
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = directories.filesystem_entry_id
                WHERE
                    directories.id = ?
            ",
            "i",
            $directory_id
        );
    }

    // Get file owner id
    public static function get_file_owner(int $file_id): ?int {
        return Database::get_first_cell("
                SELECT
                    filesystem_entries.user_id
                FROM
                    files
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = files.filesystem_entry_id
                WHERE
                    files.id = ?
            ",
            "i",
            $file_id
        );
    }

    // Get file parent directory id
    public static function get_parent_directory_id(int $file_id): ?int {
        return Database::get_first_cell("
                SELECT
                    filesystem_entries.directory_id
                FROM 
                    files
                    LEFT JOIN filesystem_entries
                    ON filesystem_entries.id = files.filesystem_entry_id
                WHERE
                    files.id = ?
            ",
            "i",
            $file_id
        );
    }
}
//------------------------------