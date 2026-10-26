<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("POST");
Request::access_level(AccessLevel::USER);

$upload_id    = Request::query_int("upload_id");
$chunk_index  = Request::query_int("chunk_index");
$file = Request::file("file");

// Obtanining upload info
$upload = Filesystem::get_upload($upload_id);

if ($upload === null)
    Response::error("Upload with id $upload_id doesn't exist");

// If user is trying to send more chunks then expected
if ($chunk_index >= $upload['chunk_count'])
    Request::error('Chunk index ' . $chunk_index . ' >= expected chunk count ' . $upload['chunk_count']);

// Moving temporary file to upload chunk path
$chunk_path = Filesystem::get_upload_path($upload_id) . $chunk_index;

if (!move_uploaded_file($file["tmp_name"], $chunk_path))
    Request::failure("Failed to move uploaded file to \"$chunk_path\"");

Response::no_content();

//=============================================