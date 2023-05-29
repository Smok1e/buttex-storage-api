<?php
require_once "database.php";
require_once "response.php";
require_once "access_level.php";

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

    // Get query param and ensure that such is exists
    public static function query_param(string $key, $default = null): mixed {
        $value = self::query_param_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing field '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }

    // Get query param and ensure that it is int, or null if such param is not passed
    public static function query_int_or_null(string $key): ?int {
        $value = self::query_param_or_null($key);
        if ($value === null)
            return null;

        if (!is_numeric($value))
            Response::error("field '$key' should contain integer");

        return intval($value);
    }

    // Get int from query and ensure that such param is passed
    public static function query_int(string $key, $default = null): int {
        $value = self::query_int_or_null($key);
        if ($value === null) {
            if ($default !== null)
                return $default;

            Response::error("missing int '$key' in request query", ResponseCode::BAD_REQUEST);
        }

        return $value;
    }

    // Get query param and ensure it exsists and is not empty
    public static function not_empty(string $key): mixed {
        $value = self::query_param($key);
        if (empty($value))
            Response::error("field '$key' should not be empty");

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

            if (!$user)
                Response::error("wrong token", ResponseCode::UNAUTHORIZED);

            if ($user["access_level"] < $level)
                Response::error("access denied", ResponseCode::FORBIDDEN);

            self::$user_id = $user["id"];
            self::$token = $user["token"];
            self::$access_level = $user["access_level"];
        }

        if (self::$access_level < $level)
            Response::error("access denied", ResponseCode::FORBIDDEN);

        return self::$user_id;
    }

    // Mark endpoint as unavailable
    public static function not_available() {
        Response::error("This method is temporary unavailable", ResponseCode::SERVICE_UNAVAILABLE);
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