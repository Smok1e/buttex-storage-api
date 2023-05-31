<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

if (strlen(Request::not_empty("new_nickname") > Config::NICKNAME_LIMIT))
    Response::error("nickname is too long");

Database::execute("
        UPDATE 
            users 
        SET 
            nickname = ? 
        WHERE 
            id = ?
    ", 
    "si", 
    strip_tags(Request::not_empty("new_nickname")),
    Request::$user_id
);

Response::ok();

//------------------------------