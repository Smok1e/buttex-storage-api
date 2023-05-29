<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);
Response::set(Database::get_first_row("SELECT * FROM todo"));

//------------------------------