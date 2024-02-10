<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_id = Request::query_int("file_id");
$hidden = Request::query_int("hidden") != 0? 1: 0;

// Check that user is able to rename file
Request::check_file_ownership($file_id);

// Set hidden flag
Database::execute("
        UPDATE 
            filesystem_entries
            LEFT JOIN files
            ON files.filesystem_entry_id = filesystem_entries.id
        SET 
            filesystem_entries.hidden = ?
        WHERE
            files.id = ?
    ",
    "si",
    $hidden,
    $file_id
);

Response::ok();

//=============================================