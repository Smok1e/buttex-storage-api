<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

$request_username     = Request::not_empty("user_name");
$request_nickname     = Request::not_empty("user_nickname");
$request_password     = Request::not_empty("user_password");
$reqeust_access_level = Request::query_int("user_access_level");
$request_avatar_url   = Request::query_param_or_null("user_avatar_url");

if (!(AccessLevel::USER <= $reqeust_access_level && $reqeust_access_level <= AccessLevel::ADMIN))
    Response::error("invalid access level value", ResponseCode::BAD_REQUEST);

if (Database::get_first_row("SELECT id FROM users WHERE name = ?", "s", $request_username) !== null)
    Response::error("this user name is already taken");

$user_id = Database::execute("
        INSERT 
            INTO users(name, nickname, password, avatar_url, token, access_level)
        VALUES(?, ?, SHA2(?, 256), ?, UUID(), ?)
    ",
    "ssssi",
    $request_username,
    $request_nickname,
    $request_password,
    $request_avatar_url,
    $reqeust_access_level
);

Response::set(Database::get_first_row("SELECT id, token FROM users WHERE id = ?", "i", $user_id));

//=============================================