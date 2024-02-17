<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$request_fields = "id, name, nickname, avatar_url, access_level";
if (Request::$access_level >= AccessLevel::ADMIN)
    $request_fields .= ", token";

$result = Database::get_first_row("
        SELECT $request_fields
        FROM 
            users 
        WHERE 
            id = ?
    ", 
    "i",
    Request::query_int("user_id")
);

if (!$result)
    Response::no_such_user();

Response::set($result);

//=============================================