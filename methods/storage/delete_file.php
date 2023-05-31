<?php 
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

// Get file owner id
$file = Database::get_first_row("
        SELECT
            files.id as `id`,
            filesystem_entries.user_id as `user_id`
        FROM
            files
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = files.filesystem_entry_id
        WHERE
            files.id = ?
    ",
    "i",
    Request::query_int("file_id")
);

// Check that such file exists
if (!$file) {
    Response::file_not_found();
}

// Check user permission
if ($file["user_id"] != Request::$user_id && Request::$access_level < AccessLevel::MODERATOR) {
    Response::error("permission denied", ResponseCode::FORBIDDEN);
}

Filesystem::delete_file($file["id"]);
Response::set();

//------------------------------