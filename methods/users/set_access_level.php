<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

$access_level = Request::query_int("access_level");
if (!(AccessLevel::USER <= $access_level && $access_level <= AccessLevel::ADMIN))
    Response::error("invalid access level", ResponseCode::BAD_REQUEST);

Database::execute("
        UPDATE 
            users 
        SET 
            access_level = ? 
        WHERE 
            id = ?
    ", 
    "si",
    $access_level,
    Request::check_user_id(Request::query_int("user_id"))
);

Response::ok();

//=============================================