<<<<<<< HEAD
<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_name   = Request::query_param("file_name");
$chunk_count = Request::query_int("chunk_count");

$upload_id = Filesystem::create_upload(
    Request::$user_id,
    $file_name,
    $chunk_count
);

Response::set([
    "upload_id" => $upload_id
]);

=======
<?php 
require_once "request.php";
require_once "filesystem.php";

//=============================================

Request::method("GET");
Request::access_level(AccessLevel::USER);

$file_name   = Request::query_param("file_name");
$chunk_count = Request::query_int("chunk_count");

$upload_id = Filesystem::create_upload(
    Request::$user_id,
    $file_name,
    $chunk_count
);

Response::set([
    "upload_id" => $upload_id
]);

>>>>>>> refs/remotes/origin/master
//=============================================