<?php
require_once "database.php";
require_once "response.php";
require_once "access_level.php";
require_once "filesystem.php";

//------------------------------

class Request {
    public static ?int    $user_id      = null;
    public static ?string $token        = null;
    public static ?int    $access_level = AccessLevel::ANY;

    // Ensure that method is correct
    public static function method(string $method) {
        if ($_SERVER["REQUEST_METHOD"] != $method)
            Response::error("expected $method request instead of " . $_SERVER["REQUEST_METHOD"], ResponseCode::METHOD_NOT_ALLOWED);
    }

    // Returns true if such param exists
    public static function param_passed(string $key): bool {
        return array_key_exists($key, $_GET);
    }
    
    // Get query param or null if not passed
    public static function query_param_or_null(string $key): mixed {
        return $_GET[$key]?? null;
    }

    // Get query param and ensure that such exists
    public static function query_param(string $key, mixed $default = null): mixed {
        $value = self::query_param_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing field '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }

    // Get query param and ensure that it is not empty
    public static function not_empty_or_null(string $key): mixed {
        $value = self::query_param_or_null($key);
        if ($value === null)
            return null;

        if (empty($value))
            Response::error("field '$key' should not be empty");

        return $value;
    }

    // Get query param and ensure that it was passed and is not empty
    public static function not_empty(string $key, mixed $default = null): mixed {
        $value = self::not_empty_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing param '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }    

    // Get query param and ensure that it is int, or null if such param was not passed
    public static function query_int_or_null(string $key): ?int {
        $value = self::query_param_or_null($key);
        if ($value === null)
            return null;

        if (!is_numeric($value))
            Response::error("field '$key' should contain integer");

        return intval($value);
    }

    // Get int from query and ensure that such param is passed
    public static function query_int(string $key, ?int $default = null): int {
        $value = self::query_int_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing int '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }

    // Get safe file base name from query, or null if such param was not passed
    public static function query_basename_or_null(string $key): ?string {
        $value = self::not_empty_or_null($key);
        if ($value === null)
            return null;

        return basename($value);
    }

    // Get safe file base name from query and ensure that it was passed
    public static function query_basename(string $key, ?string $default = null): string {
        $value = self::query_basename_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing filename '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }

    // Get file
    public static function file(string $key) {
        if (!array_key_exists($key, $_FILES)) {
            Response::error("missing file '$key'");
        }

        return $_FILES[$key];
    }

    // Check user credentials and access level
    public static function access_level(int $level): ?int {
        if (self::param_passed("token")) {
            $user = Database::get_first_row("
                    SELECT access_level, id, token
                    FROM users
                    WHERE token = ?
                ",
                "s",
                self::query_param("token")
            );

            if ($user)
            {
                self::$user_id = $user["id"];
                self::$token = $user["token"];
                self::$access_level = $user["access_level"];
            }
            
            else if ($level > AccessLevel::ANY)
                Response::error("wrong token", ResponseCode::UNAUTHORIZED);
        }

        if (self::$access_level < $level)
            Response::error("access denied", ResponseCode::FORBIDDEN);

        return self::$user_id;
    }

    // Mark endpoint as unavailable
    public static function not_available() {
        Response::error("This method is temporary unavailable", ResponseCode::SERVICE_UNAVAILABLE);
    }

    // Ensure that directory exists and user is able to write into it
    public static function check_directory_ownership(?int $directory_id, int $required_access_level = AccessLevel::MODERATOR) {
        // Null corresponds to the root directory
        if ($directory_id === null)
            return;

        $owner_id = Filesystem::get_directory_owner($directory_id);
        if ($owner_id === null) {
            Response::directory_not_found();
        }

        if (self::$access_level >= $required_access_level)
            return;

        if ($owner_id != self::$user_id)
            Response::error("you are not able to modify requested directory", ResponseCode::FORBIDDEN);
    }

    // Ensure that file exists and user is able to modify it
    public static function check_file_ownership(int $file_id, int $required_access_level = AccessLevel::MODERATOR) {
        $owner_id = Filesystem::get_file_owner($file_id);
        if ($owner_id === null) {
            Response::file_not_found();
        }

        if (self::$access_level >= $required_access_level)
            return;

        if ($owner_id != self::$user_id)
            Response::error("you are not able to modify requested file", ResponseCode::FORBIDDEN);
    }
}

//------------------------------

function internal_error_handler()
{
    $error = error_get_last();
    if ($error && $error["type"] == E_ERROR) {
        Response::error_with_data(
            "internal server error", [
                "message" => $error["message"],
                "file" => basename($error["file"]),
                "line" => $error["line"]
            ], 
            
            ResponseCode::INTERNAL_SERVER_ERROR
        );
    }
}

register_shutdown_function("internal_error_handler");

//------------------------------