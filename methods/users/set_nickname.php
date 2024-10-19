<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$user_id = Request::$user_id;
if (Request::param_passed("user_id")) {
    if (Request::$access_level < AccessLevel::ADMIN) 
        Response::error("admin access level is required to set nickname by user id", ResponseCode::FORBIDDEN);

    $user_id = Request::query_int("user_id");
}

$new_nickname = Request::not_empty("new_nickname");
if (strlen($new_nickname) > Config::NICKNAME_LIMIT)
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
    strip_tags($new_nickname),
    $user_id
);

Response::ok();

//=============================================