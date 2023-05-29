<?php 
require_once "request.php";

//------------------------------

Request::not_available();
Request::method("GET");
Request::access_level(AccessLevel::USER);

$file = Database::get_first_row(
    "SELECT id, filename, user_id, unlisted FROM files WHERE id = ?",
    "i",
    Request::query_param("file_id")
);

if (!$file)
    Response::file_not_found();

if ($file["user_id"] != Request::$user_id && Request::$access_level < AccessLevel::MODERATOR)
    Response::permission_denied();

$unlisted = $file["unlisted"];
if (Request::param_passed("unlisted")) {
    if (Request::$user_id != $file["user_id"] && Request::$access_level < AccessLevel::ADMIN)
        Response::permission_denied();

    $unlisted = Request::query_param("unlisted") != 0;
}

$new_filename = Request::query_param("new_filename", $file["filename"]);
if ($new_filename != $file["filename"] && Database::get_first_row("SELECT id FROM files WHERE filename = ?", "s", $new_filename))
    Response::error("file '$new_filename' already exists in storage");

Database::execute("
        UPDATE files
        SET 
            filename = ?,
            unlisted = ?
        WHERE id = ?
    ",
    "sii",
    $new_filename,
    $unlisted,
    $file["id"]
);

Response::ok();

//------------------------------