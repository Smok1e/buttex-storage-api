<?php
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$file_id = Filesystem::resolve_file_path(
    Request::query_param("file_name"), 
    Request::query_int_or_null("parent_directory")
);

if (!$file_id)
    Response::file_not_found();

Response::set([
    "file_id" => $file_id
]);

//------------------------------