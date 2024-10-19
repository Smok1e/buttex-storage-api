<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$user_id = Request::$user_id;
if (Request::param_passed("user_id")) {
    if (Request::$access_level < AccessLevel::ADMIN) 
        Response::error("admin access level is required to set avatar by user id", ResponseCode::FORBIDDEN);

    $user_id = Request::query_int("user_id");
}

$new_avatar_url = Request::query_param_or_null("new_avatar_url");
Database::execute("
        UPDATE 
            users 
        SET 
            avatar_url = ? 
        WHERE 
            id = ?
    ", 
    "si",
    $new_avatar_url,
    $user_id
);

Response::ok();

//=============================================