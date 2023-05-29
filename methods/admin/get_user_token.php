<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

$token = Database::get_first_cell("SELECT token FROM users WHERE id = ?", "i", Request::query_param("user_id"));
if (!$token) {
    Response::error("no such user");
}

Response::set([
    "token" => $token
]);

//------------------------------