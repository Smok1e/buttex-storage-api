<?php
require_once "codes.php";

//=============================================

class Response {
    public static function raw(string $data, int $status = ResponseCode::OK, string $content_type = "application/json") {
        $length = strlen($data);
        header("Content-Type: $content_type");
        header("Content-Length: $length");
        http_response_code($status);
        echo $data;
        
        die();
    }

    public static function set(array $data = [], int $status = ResponseCode::OK) {
        self::raw(json_encode([
                "data" => $data
            ]),
            $status
        );
    }

    public static function error_with_data(string $message, array $data = [], int $status = ResponseCode::UNPROCESSABLE_ENTITY) {
        self::raw(json_encode(["error" => $message, "error_data" => $data]), $status);
    }

    public static function error(string $message, int $status = ResponseCode::UNPROCESSABLE_ENTITY) {
        self::error_with_data($message, [], $status);
    }

    public static function ok() {
        self::set();
    }

    public static function file(string $filename) {
        $size = filesize($filename);
        header("Cache-Control: public");
        header("Content-Type: " . mime_content_type($filename));
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: " . filesize($filename));
        header("Accept-Ranges: bytes");
        header("Content-Range: bytes $size");
        readfile($filename);

        die();
    }

    public static function database_error()      { self::error("internal database error"                        ); }
    public static function invalid_request()     { self::error("invalid request"                                ); }
    public static function file_not_found()      { self::error("file not found",         ResponseCode::NOT_FOUND); }
    public static function directory_not_found() { self::error("directory not found",    ResponseCode::NOT_FOUND); }
    public static function no_such_user()        { self::error("no such user"                                   ); }
    public static function permission_denied()   { self::error("permission denied"                              ); }

    public static function none_of_params_passed(array $keys) {
        self::error("none of [" . implode(", ", $keys) . "] query fields was passed");
    }
}

//=============================================