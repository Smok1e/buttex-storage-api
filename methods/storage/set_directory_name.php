<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$directory_id = Request::query_int("directory_id");
$new_directory_name = Request::query_basename("new_directory_name");

// Check that user is able to rename directory
Request::check_directory_ownership($directory_id);

// Check that directory with new name does not exist
if (Filesystem::exists($new_directory_name, Filesystem::get_parent_directory_id($file_id)))
    Response::error("directory with such name already exists");

// Rename directory
Database::execute("
        UPDATE 
            filesystem_entries
            LEFT JOIN directories
            ON directories.filesystem_entry_id = filesystem_entries.id
        SET 
            filesystem_entries.name = ?
        WHERE
        directories.id = ?
    ",
    "si",
    $new_directory_name,
    $directory_id
);

Response::ok();

//=============================================