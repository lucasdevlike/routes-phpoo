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

    public function create(array $data)
    {
        try {

            $sql = "insert into {$this->table} (";
            $sql .= implode(',', array_keys($data)).") values (";
            $sql .= ':'. implode(',:', array_keys($data)).")";

            $connect = Connection::connect();
            $prepare = $connect->prepare($sql);

            return $prepare->execute($data);

            // dd($sql);

        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function fetchAll()
    {
        try {

            $sql = "SELECT {$this->fields} from {$this->table} {$this->filters}";
            // dd($sql);
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

    public function first($field = 'id', $order = 'asc')
    {
        try {

            $sql = "select {$this->fields} from {$this->table} order by {$field} {$order}";

            $connection = Connection::connect();
            $query = $connection->query($sql);
            return $query->fetchObject(get_called_class());

        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function delete(string $field = '', string|int $value = '')
    {

        try {
            $sql = (!empty($this->filters)) ?
            "delete from {$this->table} {$this->filters}" :
            "delete from {$this->table} where {$field} = :{$field}";

            $connection = Connection::connect();
            $prepare = $connection->prepare($sql);
            return $prepare->execute(empty($this->filters) ? [$field =>$value] : []);

            // return $prepare->fetchObject(get_called_class());
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }

    }

    public function count()
    {
        try {

            $sql = "select {$this->fields} from {$this->table} {$this->filters}";

            $connection = Connection::connect();
            $query = $connection->query($sql);
            return $query->rowCount();

        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }

}
