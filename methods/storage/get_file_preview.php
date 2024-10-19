<?php
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$file_id = Database::get_first_cell(
    "SELECT id FROM files WHERE id = ?",
    "i",
    Request::query_int("file_id")
);

if (!$file_id)
    Response::raw("File not found", ResponseCode::NOT_FOUND, "text/plain");

$preview_path = Filesystem::get_file_preview($file_id);
if ($preview_path)
    Response::file($preview_path, basename($preview_path));

Response::no_content();

//=============================================