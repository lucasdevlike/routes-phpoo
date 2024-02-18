<?php

namespace app\database\models;

use PDO;
use app\database\Filters;
use app\database\Connection;

#[\AllowDynamicProperties]
abstract class Model
{
    private string $fields = '*';
    private string $filters = '';

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
    }

    public function fetchAll()
    {
        try {

            $sql = "SELECT {$this->fields} from {$this->table} {$this->filters}";

            $connection = Connection::connect();
            $query = $connection->query($sql);
            // dd($query);
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());

        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function findBy(string $field = '', string $value = '')
    {
        try {
            if (!$this->filters) {
                $sql = "select {$this->fields} from {$this->table} where {$field} = :{$field}";
            } else {
                $sql = "select {$this->fields} from {$this->table} {$this->filters}";
            }
            $connection = Connection::connect();
            $prepare = $connection->prepare($sql);
            $prepare->execute(!$this->filters ? [$field =>$value] : []);

            return $prepare->fetchObject(get_called_class());
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }
}
