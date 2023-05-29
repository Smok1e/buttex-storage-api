<?php 
require_once "request.php";

//------------------------------

Request::method("GET");
Request::access_level(AccessLevel::ADMIN);

if (!Database::get_first_row("SELECT id FROM users WHERE id = ?", "i", Request::query_param("user_id")))
    Response::error("no such user");

$files_to_delete = Database::get_table("
        SELECT id, filename 
        FROM files
        WHERE user_id = ?
    ",
    "i",
    Request::query_param("user_id")
);

foreach($files_to_delete as $file) {
    unlink(Config::STORAGE_DATA_DIR . $file["id"]);
}

Database::execute("DELETE FROM users WHERE id = ?", "i", Request::query_param("user_id"));
Response::set([
    "deleted_files" => $files_to_delete
]);

//------------------------------