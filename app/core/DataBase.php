<?php

namespace app\core;

use mysqli;

/**
 * Singleton class for working with MySQL database using mysqli
 */
class Database
{
    /**
     * @var Database|null
     */
    private static ?self $instance = null;

    /**
     * @var mysqli
     */
    private mysqli $connector;

    /**
     * @var array
     */
    private array $errors = [
        'connection'    => 'Database connection error: ',
        'prepare'       => 'Query preparation error: ',
        'bind_param'    => 'Parameter binding error: ',
        'execute'       => 'Query execution error: ',
        'singleton'     => 'Singleton usage is not allowed.',
    ];

    /**
     * Private constructor to prevent multiple instances.
     */
    private function __construct()
    {
        $this->connector = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connector->connect_errno) {
            exit($this->errors['connection'] . $this->connector->connect_error);
        }
    }

    /**
     * Returns the singleton instance of the Database class.
     * Creates it if it does not exist yet.
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Prevents cloning of the singleton instance.
     */
    private function __clone(): void {}

    /**
     * Prevents unserializing of the singleton instance.
     *
     * @return never
     */
    public function __wakeup(): never
    {
        exit($this->errors['singleton']);
    }

    /**
     * Executes a prepared SQL query with parameters.
     * @param string $query
     * @param string $types
     * @param array $params
     * @return array|bool
     */
    public function query(string $query, string $types = '', array $params = []): array|bool
    {
        $stmt = $this->connector->prepare($query);
        if (!$stmt) {
            exit($this->errors['prepare'] . $this->connector->error);
        }

        if ($params) {
            if (!$stmt->bind_param($types, ...$params)) {
                $stmt->close();
                exit($this->errors['bind_param'] . $stmt->error);
            }
        }

        if (!$stmt->execute()) {
            $stmt->close();
            exit($this->errors['execute'] . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result instanceof \mysqli_result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        }

        $stmt->close();
        return true;
    }
}
