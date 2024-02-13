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
            nickname = ? 
        WHERE 
            id = ?
    ", 
    "si",
    strip_tags($new_nickname),
    $access_level
);

Response::ok();

//=============================================