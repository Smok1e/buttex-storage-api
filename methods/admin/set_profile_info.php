<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

$user = Database::get_first_row("
        SELECT username, nickname, id
        FROM users 
        WHERE id = ?
    ", 
    "i", 
    Request::query_param("user_id")
);

Database::execute("
        UPDATE users 
        SET 
            nickname = ?,
            access_level = ?
        WHERE id = ?
    ", 
    "sii", 
    Request::not_empty("new_nickname"),
    Request::query_param("new_access_level"),
    Request::query_param("user_id"),
);

Response::ok();

//------------------------------