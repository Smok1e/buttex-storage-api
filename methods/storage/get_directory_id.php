<?php
require_once "request.php";
require_once "filesystem.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);
Response::set([
    "directory_id" => Filesystem::resolve_directory_path(
        Request::query_param("path"), 
        Request::query_int_or_null("parent_directory")
    )
]);

//------------------------------