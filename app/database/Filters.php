<?php

namespace app\database;

class Filters
{
    private array $filters = [];

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

        $this->filters['where'][] = "{$field} {$operator} {$value} {$logic}";

    }

    public function limit(int $limit)
    {
        $this->filters['limit'] = " limit {$limit}";
    }

    public function orderBy(string $field, string $order = 'asc')
    {
        $this->filters['order'] = " order by {$field} {$order}";
    }

    public function dump()
    {
        $filter = !empty($this->filters['where']) ? 'where ' . implode(' ', $this->filters['where']) : '';
        $filter .= $this->filters['order'] ?? '';
        $filter .= $this->filters['limit'] ?? '';

        return$filter;
    }
}
