<?php
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$file_id = Filesystem::resolve_file_path(Request::query_param("path"));

if (!$file_id)
    Response::raw("File not found", ResponseCode::NOT_FOUND, "text/plain");

Response::file($filename = Config::STORAGE_DATA_DIR . $file_id);

//------------------------------