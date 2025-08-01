<?php 
require_once "config.php";
require_once "database.php";
require_once "filesystem.php";

//=============================================

echo "Scanning filesystem...\n";
$database_files = Database::get_column(
    "id", 
    "SELECT id FROM files"
);

$storage_files = array_diff(
    scandir(Config::STORAGE_BASE_DIR . Config::STORAGE_DATA_DIR), [".", ".."]
);

$remove_from_database = array_diff($database_files, $storage_files );
$remove_from_storage  = array_diff($storage_files,  $database_files);

if (empty($remove_from_database) && empty($remove_from_storage)) {
    // Bright green foreground
    echo "\033[92mNo difference found\033[0m\n";
    die();
}

if (!empty($remove_from_database)) {
    // Dark orange foreground
    echo "\033[33mFound " . count($remove_from_database) . " files existing in database, but not in filesystem\033[0m\n";
}

if (!empty($remove_from_storage)) {
    $total_size = 0;
    foreach ($remove_from_storage as $file_id) {
        $total_size += filesize(Filesystem::get_real_path($file_id));
    }

    // Dark orange foreground
    echo "\033[33mFound " . count($remove_from_storage) . " files existing in filesystem, but not in database with total size of $total_size bytes\033[0m\n";
}

echo "Specified mismatches will be deleted permanently.\n"; 
echo "Do you want to continue? [y/n]: ";

// Checking user input
$stdin = fopen("php://stdin", "r");
$input = fgets($stdin);
fclose($stdin);

if (str_starts_with($input, "y")) {
    echo "Deleting mismatches... ";

    Database::execute("
        DELETE 
            filesystem_entries
        FROM
            files
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = files.filesystem_entry_id
        WHERE
            files.id IN (" . implode(",", $remove_from_database) . ")
    ");

    foreach ($remove_from_storage as $file_id) {
        unlink(Filesystem::get_real_path($file_id));
    }

    echo "Done\n";
}

else {
    echo "Aborting\n";
}

//=============================================