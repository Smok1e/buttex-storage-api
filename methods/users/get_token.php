<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$result = Database::get_first_row("
        SELECT 
            token as `token`, 
            id as `user_id`
        FROM 
            users
        WHERE 
            name = ?
            AND password = SHA2(?, 256)
    ",
    "ss",
    Request::query_param("user_name"),
    Request::query_param("user_password")
);

if (!$result) 
    Response::error("wrong username or password", ResponseCode::UNAUTHORIZED);
    
Response::set($result);

//=============================================