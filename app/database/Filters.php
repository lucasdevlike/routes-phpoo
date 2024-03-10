<?php

namespace app\database;

class Filters
{
    private array $filters = [];
    private array $binds = [];

    public function where(string $field, string $operator, mixed $value, string $logic = '')
    {
        $formater = '';

        if (is_array($value)) {
            $formater = "('" . implode("','", $value) . "')";
        } elseif (is_string($value)) {
            $formater = "'{$value}'";
        } elseif (is_bool($value)) {
            $formater = $value ? 1 : 0;
        } else {
            $formater = $value;
        }

        $value = strip_tags($formater);

        // $this->filters['where'][] = "{$field} {$operator} {$value} {$logic}";
        $fieldBind = str_contains($field, '.') ? str_replace('.', '', $field) : $field;
        $this->filters['where'][] = "{$field} {$operator} :{$fieldBind} {$logic}";
        $this->binds[$fieldBind] = $value;

    }

    public function getBind()
    {
        return $this->binds;
    }

    public function limit(int $limit)
    {
        $this->filters['limit'] = " limit {$limit}";
    }

    public function orderBy(string $field, string $order = 'asc')
    {
        $this->filters['order'] = " order by {$field} {$order}";
    }

    public function join(string $foreignTable, string $joinTable1, string $operator, string $joinTable2, string $joinType = 'inner join')
    {
        $this->filters['join'][] = "{$joinType} {$foreignTable} on {$joinTable1} {$operator} {$joinTable2}";
    }

    public function dump()
    {
        $filter = !empty($this->filters['join']) ? implode(' ', $this->filters['join']) : '';
        $filter .= !empty($this->filters['where']) ? ' where ' . implode(' ', $this->filters['where']) : '';
        $filter .= $this->filters['order'] ?? '';
        $filter .= $this->filters['limit'] ?? '';

        return$filter;
    }
}
