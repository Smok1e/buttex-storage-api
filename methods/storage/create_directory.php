<?php 
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

$request_directory_name      = basename(Request::query_param("directory_name"));
$request_parent_directory_id = Request::query_int_or_null("parent_directory_id");
$request_hidden              = Request::query_int("hidden", 0);

if ($request_parent_directory_id !== null)
    Request::check_directory_ownership($request_parent_directory_id);

if (Filesystem::exists($request_directory_name, $request_parent_directory_id))
    Response::error("file or directory with name '$request_directory_name' already exists in specified directory");

$filesystem_entry_id = Filesystem::create_entry(
    $request_directory_name,
    Request::$user_id,
    $request_parent_directory_id,
    $request_hidden
);

Response::set([
    "directory_id" => Filesystem::cretate_directory($filesystem_entry_id)
]);

//------------------------------