<?php
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$parent_dir_id = Request::query_int_or_null("parent_directory_id");

$criteria = $parent_dir_id === null
    ? "directory_id IS NULL"
    : "directory_id = " . $parent_dir_id;

if (Request::$user_id !== null) {
    if (Request::$access_level < AccessLevel::ADMIN) {
        $criteria .= "
            AND (
                filesystem_entries.hidden = 0 OR 
                filesystem_entries.user_id = " . Request::$user_id . "
            )
        ";
    }
}

else $criteria .= " AND filesystem_entries.hidden = 0";

$common_fields = "
    filesystem_entries.name as `name`,
    filesystem_entries.directory_id as `directory_id`,
    filesystem_entries.hidden as `hidden`,
    UNIX_TIMESTAMP(filesystem_entries.creation_time) as `creation_time`,
    users.id as `user_id`,
    users.name as `user_name`,
    users.nickname as `user_nickname`
";

$directory_path = Filesystem::resolve_directory_id($parent_dir_id);

$files = Database::get_table("
        SELECT 
            files.id as `id`,
            files.lifetime as `lifetime`,
            UNIX_TIMESTAMP(files.modification_time) as `modification_time`,
            $common_fields
        FROM 
            files
        
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = files.filesystem_entry_id
        
            LEFT JOIN users
            ON filesystem_entries.user_id = users.id

        WHERE $criteria
        ORDER BY files.id DESC
    "
);

foreach($files as &$file) {
    $file["size"] = Filesystem::get_file_size($file["id"]);
    $file["type"] = Filesystem::get_file_mime_type($file["id"]);
    $file["has_preview"] = Filesystem::get_file_preview_type($file["id"]) != FilePreviewType::None? 1: 0;
    $file["url"] = Config::SERVER_BASE_URL . "/data" . $directory_path . "/" . $file["name"];
    $file["permanent_url"] = Filesystem::get_file_permanent_url($file["id"]);
}

$directories = Database::get_table("
        SELECT directories.id as `id`, $common_fields
        FROM
            directories
            
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = directories.filesystem_entry_id

            LEFT JOIN users
            ON filesystem_entries.user_id = users.id

        WHERE $criteria
        ORDER BY directories.id DESC
    "
);

Response::set([
    "files" => $files,
    "directories" => $directories
]);

//=============================================