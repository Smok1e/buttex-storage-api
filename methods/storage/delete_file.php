<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_id = Request::query_int("file_id");

// Check fhat user is able to delete file
Request::check_file_ownership($file_id, AccessLevel::ADMIN);

// Delete file
Filesystem::delete_file($file_id);
Response::ok();

//=============================================