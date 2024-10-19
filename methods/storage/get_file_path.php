<?php
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$path = Filesystem::resolve_file_id(Request::query_int_or_null("file_id"));
if ($path === null)
    Response::file_not_found();

Response::set([
    "path" => $path
]);

//=============================================