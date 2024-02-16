<?php 
require_once "request.php";
require_once "database.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$file_id = Request::query_int("file_id");
$file_info = Database::get_first_row("
        SELECT
            files.id as `id`,
            files.lifetime as `lifetime`,
            filesystem_entries.name as `name`,
            filesystem_entries.directory_id as `directory_id`,
            filesystem_entries.hidden as `hidden`,
            UNIX_TIMESTAMP(filesystem_entries.creation_time) as `creation_time`,
            UNIX_TIMESTAMP(files.modification_time) as `modification_time`,
            users.id as `user_id`,
            users.name as `user_name`,
            users.nickname as `user_nickname`

        FROM 
            files

            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = files.filesystem_entry_id
        
            LEFT JOIN users
            ON filesystem_entries.user_id = users.id

        WHERE
            files.id = ?
    ",
    "i",
    $file_id
);

if ($file_info === null) {
    Response::file_not_found();
}

Response::set(array_merge(
    $file_info, [
        "size" => Filesystem::get_file_size($file_id),
        "url" => Filesystem::get_file_url($file_id),
        "permanent_url" => Filesystem::get_file_permanent_url($file_id),
        "type" => Filesystem::get_file_mime_type($file_id),
        "has_preview" => Filesystem::get_file_preview_type($file_id) != FilePreviewType::None? 1: 0
    ])
);


//=============================================