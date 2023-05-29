<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);
Response::set(Database::get_table("
        SELECT 
            id,
            username as `name`,
            nickname,
            access_level
        FROM users
"));

//------------------------------