<?php
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);
Response::set([
    "path" => Filesystem::resolve_directory_id(Request::query_int_or_null("directory_id"))
]);

//=============================================