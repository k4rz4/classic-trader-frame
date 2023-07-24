<?php

namespace App\ClassicTrader\Core;

use PDO;
use PDOException;

class Database
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function get(string $table, array $fields = ["*"], array $where = []): array
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

    public function getCount(string $table, string $field, array $where = []): ?int
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

    public function getDistinct(string $table, string $field): array
    {
        $sql = "SELECT DISTINCT " . $field . " FROM " . $table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $result;
    }

    public function insert(string $table, array $data): string
    {
        $fields = array_keys($data);
        $placeholders = array_fill(0, count($fields), '?');

        $sql = "INSERT INTO " . $table . " (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(array_values($data));

        return $this->conn->lastInsertId();
    }

    public function update(string $table, array $data, array $where): void
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
