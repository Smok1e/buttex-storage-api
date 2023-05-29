<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);
Database::execute("UPDATE todo SET text = ?", "s", Request::query_param("text"));
Response::ok();

//------------------------------