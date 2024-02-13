<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$user_id = Request::$user_id;
if (Request::param_passed("user_id")) {
    if (Request::$access_level < AccessLevel::ADMIN) 
        Response::error("admin access level is required to set password by user id", ResponseCode::FORBIDDEN);

    $user_id = Request::query_int("user_id");
}

Database::execute("
        UPDATE 
            users 
        SET 
            password = SHA2(?, 256),
            token = UUID()
        WHERE 
            id = ?
    ", 
    "si", 
    Request::not_empty("new_password"),
    $user_id
);

Response::ok();

//=============================================