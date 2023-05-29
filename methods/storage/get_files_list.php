<?php
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$criteria = Request::param_passed("parent_directory_id")
    ? "directory_id = " . Request::query_int("parent_directory_id")
    : "directory_id IS NULL";

$common_fields = "
    filesystem_entries.name as `name`,
    filesystem_entries.directory_id as `directory_id`,
    filesystem_entries.hidden as `hidden`,
    UNIX_TIMESTAMP(filesystem_entries.creation_time) as `creation_time`,
    users.id as `user_id`,
    users.name as `user_name`,
    users.nickname as `user_nickname`
";

$files = Database::get_table("
        SELECT files.id as `id`, $common_fields
        FROM 
            files
        
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = files.filesystem_entry_id
        
            LEFT JOIN users
            ON filesystem_entries.user_id = users.id

        WHERE filesystem_entries.hidden = 0 AND $criteria
        ORDER BY files.id DESC
    "
);

$directories = Database::get_table("
        SELECT directories.id as `id`, $common_fields
        FROM
            directories
            
            LEFT JOIN filesystem_entries
            ON filesystem_entries.id = directories.filesystem_entry_id

            LEFT JOIN users
            ON filesystem_entries.user_id = users.id

        WHERE filesystem_entries.hidden = 0 AND $criteria
        ORDER BY directories.id DESC
    "
);

Response::set([
    "files" => $files,
    "directories" => $directories
]);

//------------------------------