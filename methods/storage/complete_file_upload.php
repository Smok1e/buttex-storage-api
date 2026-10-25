<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$request_upload_id           = Request::query_int("upload_id");
$request_parent_directory_id = Request::query_int_or_null("parent_directory_id");
$request_hidden              = Request::query_int("hidden", 0);
$request_lifetime            = Request::query_int_or_null("lifetime");

// Obtanining upload info
$upload = Filesystem::get_upload($request_upload_id);

if ($upload === null)
    Response::error("Upload with id $request_upload_id doesn't exist");

$upload_path = Filesystem::get_uploads_path() . $request_upload_id . '/';

// Checking if all chunk exist & merge is possible
for ($chunk_index = 0; $chunk_index < $upload['chunk_count']; $chunk_index++) {
    $chunk_path = $upload_path . $chunk_index;

    if (!is_file($chunk_path))
        Response::error("Chunk file \"$chunk_path\" is missing, merge couldn't be completed.");
}

// Merging chunks
$merged_path = $upload_path . 'merged';
$merged_stream = fopen($merged_path, 'w');

if (!$merged_stream)
    Response::error("Failed to open merged file stream: $merged_stream");

for ($chunk_index = 0; $chunk_index < $upload['chunk_count']; $chunk_index++) {
    $chunk_path = $upload_path . $chunk_index;

    // Copying chunk contents into merged file
    $chunk_stream = fopen($chunk_path, 'r');

    if (!$chunk_stream) {
        fclose($merged_stream);
        Response::error("Failed to open chunk file stream: $chunk_stream");
    }

    stream_copy_to_stream($chunk_stream, $merged_stream);

    fclose($chunk_stream);

    // Deleting chunk file
    if (!unlink($chunk_path)) {
        fclose($merged_stream);
        Response::error("Failed to delete chunk file: $chunk_path");
    }
}

fclose($merged_stream);

// Creating filesystem entry
$filesystem_entry_id = Filesystem::create_entry(
    $upload['file_name'],
    Request::$user_id, 
    $request_parent_directory_id, 
    $request_hidden
);

$file_id = Filesystem::create_file($filesystem_entry_id, $request_lifetime);

// Moving merged file to final location
$real_file_path = Filesystem::get_real_path($file_id);

if (!rename($merged_path, $real_file_path))
    Request::failure("Failed to rename $merged_path into $real_file_path");

// Deleting upload from DB
Filesystem::delete_upload($request_upload_id);

Response::set([
    "file_id" => $file_id,
    "file_url" => Filesystem::get_file_url($file_id),
    "file_premanent_url" => Filesystem::get_file_permanent_url($file_id)
]);

//=============================================