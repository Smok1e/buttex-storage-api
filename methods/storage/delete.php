<?php 
require_once "request.php";

//------------------------------

Request::not_available();
Request::method("GET");
Request::access_level(AccessLevel::USER);

$file = null;
if (Request::param_passed("file_id")) {
    $file = Database::get_first_row(
        "SELECT id, user_id, filename FROM files WHERE id = ?",
        "i",
        Request::query_param("file_id")
    );
}
else if (Request::param_passed("filename")) {
    $file = Database::get_first_row(
        "SELECT id, user_id, filename FROM files WHERE filename = ?",
        "s",
        Request::query_param("filename")
    );
}
else Response::none_of_params_passed(["file_id", "filename"]);

if (!$file)
    Response::file_not_found();

if ($file["user_id"] != Request::$user_id && Request::$access_level < AccessLevel::MODERATOR)
    Response::error("you don't have permission to delete other people's files");

unlink(Config::STORAGE_DATA_DIR . $file["id"]);
Database::execute("DELETE FROM files WHERE id = ?", "i", $file["id"]);
Response::ok();

//------------------------------