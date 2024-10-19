<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("POST");
Request::access_level(AccessLevel::USER);

$request_file                = Request::file("file");
$request_file_base_name      = basename($request_file["name"]);
$request_parent_directory_id = Request::query_int_or_null("parent_directory_id");
$request_hidden              = Request::query_int("hidden", 0);
$request_lifetime            = Request::query_int_or_null("lifetime");

// Check that user is able to write into requested directory
Request::check_directory_ownership($request_parent_directory_id);

// Check that such file does not exist
if (Filesystem::exists($request_file_base_name, $request_parent_directory_id))
    Response::error("file or directory with name '$request_file_base_name' already exists in specified directory");

// Create filesystem entry
$filesystem_entry_id = Filesystem::create_entry(
    $request_file_base_name,
    Request::$user_id, 
    $request_parent_directory_id, 
    $request_hidden
);

$file_id = Filesystem::create_file($filesystem_entry_id, $request_lifetime);

// Receive file
if (!move_uploaded_file($request_file["tmp_name"], Filesystem::get_real_path($file_id))) {
    Filesystem::delete_entry($filesystem_entry_id);
    Response::error("unable to accept file ($request_file[error])");
}

Response::set([
    "file_id" => $file_id,
    "file_url" => Filesystem::get_file_url($file_id),
    "file_premanent_url" => Filesystem::get_file_permanent_url($file_id)
]);

//=============================================