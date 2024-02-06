<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$result = Database::get_first_row("
        SELECT 
            id, 
            name, 
            nickname, 
            access_level 
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

//------------------------------