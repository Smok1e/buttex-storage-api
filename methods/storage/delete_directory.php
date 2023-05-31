<?php 
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

$directory = Database::get_first_row("
        SELECT
            directories.id as `id`,
            filesystem_entries.user_id as `user_id`
        FROM
            directories
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = directories.filesystem_entry_id
        WHERE
            directories.id = ?
    ",
    "i",
    Request::query_int("directory_id")
);

if (!$directory) {
    Response::directory_not_found();
}

if ($directory["user_id"] != Request::$user_id && Request::$access_level < AccessLevel::MODERATOR) {
    Response::error("permission denied", ResponseCode::FORBIDDEN);
}

Filesystem::delete_directory($directory["id"]);
Response::ok();

//------------------------------