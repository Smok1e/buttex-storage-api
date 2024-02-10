<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

$request_user_id = Request::query_int("user_id");
if (Database::get_first_row("SELECT id FROM users WHERE id = ?", "i", $request_user_id) === null)
    Response::no_such_user();

foreach (Filesystem::get_user_directories($request_user_id) as $directory_id)
    Filesystem::delete_directory($directory_id);

foreach (Filesystem::get_user_files($request_user_id) as $file_id)
    Filesystem::delete_file($file_id);

Database::execute("DELETE FROM users WHERE id = ?", "i", $request_user_id);
Response::ok();

//=============================================