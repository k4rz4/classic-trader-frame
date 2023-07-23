<?php

namespace App\ClassicTrader\Core;

use PDO;
use PDOException;

class Database
{
    private static $host;
    private static $user;
    private static $password;
    private static $database;
    private $conn;

    public function __construct(string $host, string $database, string $user, string $password)
    {
        self::$host = $host;
        self::$user = $user;
        self::$password = $password;
        self::$database = $database;
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$database . ";charset=utf8",
                self::$user,
                self::$password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            throw new Exception("Failed to connect to MySQL: " . $e->getMessage());
        }
    }

    public function get(string $table, array $fields = ["*"], array $where = [])
    {
        $sql = "SELECT " . implode(",", $fields) . " FROM " . $table;

        if (!empty($where)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = $key . " = :" . $key;
            }
            $sql .= implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($sql);

        foreach ($where as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount(string $table, string $field, array $where = [])
    {
        $sql = "SELECT COUNT(" . $field . ") as count FROM " . $table;

        if (!empty($where)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = $key . " = :" . $key;
            }
            $sql .= implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($sql);

        foreach ($where as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] ?? null;
    }

    public function getDistinct(string $table, string $field)
    {
        $sql = "SELECT DISTINCT " . $field . " FROM " . $table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $result;
    }

    public function insert(string $table, array $data)
    {
        $fields = array_keys($data);
        $placeholders = array_fill(0, count($fields), '?');

        $sql = "INSERT INTO " . $table . " (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(array_values($data));

        return $this->conn->lastInsertId();
    }

    public function update(string $table, array $data, array $where)
    {
        $setPart = [];
        foreach ($data as $key => $value) {
            $setPart[] = $key . ' = ?';
        }

        $wherePart = [];
        foreach ($where as $key => $value) {
            $wherePart[] = $key . ' = ?';
        }

        $sql = "UPDATE " . $table . " SET " . implode(', ', $setPart) . " WHERE " . implode(' AND ', $wherePart);
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(array_merge(array_values($data), array_values($where)));
    }
}

?>
