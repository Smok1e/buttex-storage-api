<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("POST");
Request::access_level(AccessLevel::USER);

$request_file_id = Request::query_int("file_id");
$request_file    = Request::file("file");

// Ensure that file exists and user is able to modify it
Request::check_file_ownership($request_file_id);

// First receive file into tmp location to not
// break original file in case of upload failure
$tmp_path = "/tmp/file_" . $request_file_id;
if (!move_uploaded_file($request_file["tmp_name"], $tmp_path)) {
    Response::error("unable to accept file ($request_file[error])");
}

// Move received file into the storage
rename($tmp_path, Filesystem::get_real_path($request_file_id));

// Update file modification time
Database::execute("UPDATE files SET modification_time = CURRENT_TIMESTAMP() WHERE id = ?", "i", $request_file_id);

Response::set([
    "file_id" => $request_file_id,
    "file_url" => Filesystem::get_file_url($request_file_id),
    "file_premanent_url" => Filesystem::get_file_permanent_url($request_file_id)
]);

//=============================================