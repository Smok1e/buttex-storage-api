<?php
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::ANY);

$file_id = null;
if (Request::param_passed("file_id")) {
    // Ensure that such file exists
    $file_id = Database::get_first_cell(
        "SELECT id FROM files WHERE id = ?", 
        "i",
        Request::query_int("file_id")
    );
}

else if (Request::param_passed("path")) {
    $file_id = Filesystem::resolve_file_path(Request::query_param("path"));
}

else {
    Response::raw(
        "Expected at least file_id or filename query, but none of them was found", 
        ResponseCode::BAD_REQUEST, 
        "text/plain"
    );
}

if (!$file_id)
    Response::raw("File not found", ResponseCode::NOT_FOUND, "text/plain");

Response::file(Config::STORAGE_DATA_DIR . $file_id);

//=============================================