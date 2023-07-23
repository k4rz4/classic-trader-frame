<?php
namespace App\ClassicTrader\Core;

interface Retrievable {
    public function get(string $table, array $fields = ["*"], array $where = []);
}

interface Countable {
    public function getCount(string $table, string $field, array $where = []);
}

interface Distinct {
    public function getDistinct(string $table, string $field);
}

interface Creatable {
    public function insert(string $table, array $fields = [], array $values = []);
}

interface Updatable {
    public function update(string $table, array $fields = [], array $values = [], array $where = []);
}

abstract class Model {
    protected Database $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }
}