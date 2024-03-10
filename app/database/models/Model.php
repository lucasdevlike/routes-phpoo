<?php

namespace app\database\models;

use PDO;
use app\database\Filters;
use app\database\Connection;
use app\database\Pagination;

#[\AllowDynamicProperties]
abstract class Model
{
    private string $fields = '*';
    private ?Filters $filters = null;
    private string $pagination = '';
    protected string $table;

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        // $this->filters = $filters->dump();
        $this->filters = $filters;
    }

    public function setPagination(Pagination $pagination)
    {
        $pagination->setTotalItems($this->count());

        $this->pagination = $pagination->dump();
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

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function update(string $field, string|int $fildValue, array $data)
    {
        try {

            $sql = "update {$this->table} set ";
            foreach ($data as $key => $value) {
                $sql .= "{$key} = :{$key},";
            }

            $sql = rtrim($sql, ',');
            $sql.= " where {$field} = :{$field}";

            $connect = Connection::connect();

            $data[$field] = $fildValue;

            $prepare = $connect->prepare($sql);

            return $prepare->execute($data);

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function fetchAll()
    {
        try {

            $sql = "SELECT {$this->fields} from {$this->table} {$this->filters?->dump()} {$this->pagination}";

            $connection = Connection::connect();
            // $query = $connection->query($sql);
            $prepare = $connection->prepare($sql);
            $prepare->execute($this->filters ? $this->filters->getBind() : []);

            // return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
            return $prepare->fetchAll(PDO::FETCH_CLASS);

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function findBy(string $field = '', string $value = '')
    {
        try {
            if (!$this->filters) {
                $sql = "select {$this->fields} from {$this->table} where {$field} = :{$field}";
            } else {
                $sql = "select {$this->fields} from {$this->table} {$this->filters?->dump()}";
            }
            $connection = Connection::connect();
            $prepare = $connection->prepare($sql);
            // $prepare->execute(!$this->filters ? [$field =>$value] : []);
            $prepare->execute($this->filters ? $this->filters->getBind() : [$field =>$value]);

            return $prepare->fetchObject();
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function first($field = 'id', $order = 'asc')
    {
        try {

            $sql = "select {$this->fields} from {$this->table} order by {$field} {$order}";

            $connection = Connection::connect();
            $query = $connection->query($sql);
            // return $query->fetchObject(get_called_class());
            return $query->fetchObject();

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
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
            return $prepare->execute(empty($this->filters) ? [$field =>$value] : $this->filters->getBind());

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }

    }

    public function count()
    {
        try {

            // $sql = "select {$this->fields} from {$this->table} {$this->filters}";
            $sql = "select {$this->fields} from {$this->table} {$this->filters->dump()}";

            $connection = Connection::connect();
            // $query = $connection->query($sql);

            $prepare = $connection->prepare($sql);
            $prepare->execute($this->filters ? $this->filters->getBind() : []);

            // return $query->rowCount();
            return $prepare->rowCount();

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

}
