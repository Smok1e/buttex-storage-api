<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

if (Database::get_first_row("SELECT id FROM users WHERE username = ?", "s", Request::query_param("username")))
    Response::error("such user already exists");

Database::execute("
        INSERT INTO users(username, nickname, password, access_level)
        VALUES(?, ?, PASSWORD(?), ?)
    ",
    "sssi",
    Request::not_empty("username"),
    Request::not_empty("nickname"),
    Request::not_empty("password"),
    Request::query_param("access_level")
);

Response::ok();

//------------------------------