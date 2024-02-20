<?php

namespace app\database;

class Pagination
{
    private int $currentPage = 1; // pagina atual
    private int $totalPages; //Total de paginas
    private int $linksPerPage = 5;
    private int $itemsPerPage = 10;
    private int $totalItems;

    private string $pageIdentifier = 'page';

    public function setTotalItems(int $totalItems)
    {
        $this->totalItems = $totalItems;
    }

    public function setPageIdentifier(string $identifier)
    {
        $this->pageIdentifier = $identifier;
    }

    public function setItemsPerPage(int $itensPerPage)
    {
        $this->itemsPerPage = $itensPerPage;
    }


    private function calculations()
    {
        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage -1) * $this->itemsPerPage;

        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);

        return "limit {$this->itemsPerPage} offset {$offset}";
    }

    public function dump()
    {
        return $this->calculations();
    }

}
