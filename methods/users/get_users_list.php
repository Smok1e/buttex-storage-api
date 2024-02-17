<?php 
require_once "request.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::MODERATOR);

Response::set(Database::get_table("
        SELECT 
            id, 
            name, 
            nickname,
            avatar_url,
            UNIX_TIMESTAMP(timestamp) as `timestamp`,
            access_level
        FROM 
            users
    "
));

//=============================================