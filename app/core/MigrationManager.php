<?php

namespace app\core;

use app\core\DataBase;

class MigrationManager
{
    /**
     * @var \app\core\DataBase
     */
    private DataBase $db;

    /**
     * @var \mysqli
     */
    private \mysqli $conn;

    /**
     * @var string
     */
    private string $migrationsPath;

    /**
     * MigrationManager constructor.
     * @param string $migrationsPath
     */
    public function __construct(string $migrationsPath)
    {
        $this->db = DataBase::getInstance();
        $this->conn = $this->db->getConnection();
        $this->migrationsPath = $migrationsPath;
    }

    /**
     * Runs the migrations that have not been applied yet.
     * @return void
     */
    public function migrate(): void
    {
        $this->createMigrationsTable();

        $appliedMigrations = $this->getAppliedMigrations();
        $migrationFiles = scandir($this->migrationsPath);
        $newMigrations = array_diff($migrationFiles, $appliedMigrations);

        foreach ($newMigrations as $migration) {
            if (str_ends_with($migration, '.php')) {
                require_once $this->migrationsPath . '/' . $migration;

                $stmt = $this->conn->prepare("INSERT INTO migrations (migration) VALUES (?)");
                $stmt->bind_param("s", $migration);
                $stmt->execute();
            }
        }
    }

    /**
     * Creates the migrations table if it does not exist.
     * @return void
     */
    private function createMigrationsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        $this->conn->query($sql);
    }

    /**
     * Return the list of applied migrations from the database.
     * @return array
     */
    private function getAppliedMigrations(): array
    {
        $result = $this->conn->query("SELECT migration FROM migrations");
        $migrations = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $migrations[] = $row['migration'];
            }
        }

        return $migrations;
    }
}
