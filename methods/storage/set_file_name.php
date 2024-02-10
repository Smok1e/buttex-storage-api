<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_id = Request::query_int("file_id");
$new_file_name = Request::query_basename("new_file_name");

// Check that user is able to rename file
Request::check_file_ownership($file_id);

// Check that file with new name does not exist
if (Filesystem::exists($new_file_name, Filesystem::get_parent_directory_id($file_id)))
    Response::error("file with such name already exists in storage");

// Rename file
Database::execute("
        UPDATE 
            filesystem_entries
            LEFT JOIN files
            ON files.filesystem_entry_id = filesystem_entries.id
        SET 
            filesystem_entries.name = ?
        WHERE
            files.id = ?
    ",
    "si",
    $new_file_name,
    $file_id
);

Response::ok();

//=============================================