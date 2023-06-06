<?php 
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

$directory_id = Request::query_int("directory_id");

// Check that user is able to delete directory
Request::check_directory_ownership($directory_id);

// Deleting directory
Filesystem::delete_directory($directory_id);
Response::ok();

//------------------------------