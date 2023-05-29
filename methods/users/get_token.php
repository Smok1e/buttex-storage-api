<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$result = Database::get_first_row("
        SELECT token
        FROM users
        WHERE name = ?
        AND password = PASSWORD(?)
    ",
    "ss",
    Request::query_param("user_name"),
    Request::query_param("password")
);

if (!$result) 
    Response::error("wrong username or password", ResponseCode::UNAUTHORIZED);
    
Response::set($result);

//------------------------------