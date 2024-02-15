<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_id = Request::query_int("file_id");
$new_file_lifetime = Request::query_basename("new_file_lifetime");

// Check that user is able to rename file
Request::check_file_ownership($file_id);

// Change lifetime
Database::execute("UPDATE files SET files.lifetime = ? WHERE files.id = ?", "ii", $new_file_lifetime, $file_id);

Response::ok();

//=============================================