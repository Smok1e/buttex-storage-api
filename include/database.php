<?php
require_once "config.php";
require_once "response.php";

//------------------------------

class Database {
    static mysqli $connection;

	private static function prepare(string $query, ...$args) {
		if (!$statement = self::$connection->prepare($query))
            Response::database_error();

		if (count($args) > 1 && !$statement->bind_param(...$args))
            Response::database_error();

		if (!$statement->execute())
            Response::database_error();

		return $statement;
	}    

    // Execute statement
	public static function execute(...$args): int {
		self::prepare(...$args)->close();
        return self::$connection->insert_id;
	}

    // Get table
	public static function get_table(...$args): array {
		$statement = self::prepare(...$args);
		$mysqliResult = $statement->get_result();

		if (!$mysqliResult)
            Response::database_error();

		$result = $mysqliResult->fetch_all(MYSQLI_ASSOC);

		$mysqliResult->free();
		$statement->close();

		return $result;
	}

    // Get row identified by $row index (returns null if row not exists)
    public static function get_row(int $row, ...$args): ?array {
        $table = self::get_table(...$args);
        if ($row >= count($table))
            return null;

        return $table[$row];
    }

    // Get first row from table (returns null if table is empty)
    public static function get_first_row(...$args): ?array {
        return self::get_row(0, ...$args);
    }

    // Get cell value from table by $row and $column indices (returns null if no such cell exists)
    public static function get_cell(int $row, mixed $column, ...$args): mixed {
        $row = self::get_row($row, ...$args);
        if (!$row)
            return null;

        if (!array_key_exists($column, $row))
            return null;

        return $row[$column];
    }

    // Get first (top left) cell from table (null if table is empty)
    public static function get_first_cell(...$args): mixed {
        $row = self::get_first_row(...$args);
        if (!$row || empty($row))
            return null;

        return $row[array_key_first($row)];
    }

    // Get table column
    public static function get_column(mixed $column, ...$args): array {
        return array_column(self::get_table(...$args), $column);
    }
}

Database::$connection = new mysqli(
    Config::DATABASE_HOST, 
    Config::DATABASE_USER, 
    Config::DATABASE_PASS, 
    Config::DATABASE_NAME, 
    Config::DATABASE_PORT
);

Database::$connection->set_charset('utf8mb4');

//------------------------------