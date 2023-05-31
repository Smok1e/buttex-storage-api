<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::USER);

Database::execute("
        UPDATE 
            users 
        SET 
            password = PASSWORD(?),
            token = UUID()
        WHERE 
            id = ?
    ", 
    "si", 
    Request::not_empty("new_password"),
    Request::$user_id
);

Response::ok();

//------------------------------