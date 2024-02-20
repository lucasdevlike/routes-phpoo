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

    public function links()
    {
        $links = '<ul class="pagination">';

        if ($this->currentPage > 1) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));

            $links .= "<li class='page-item'><a href='?{$linkPage}'>Anterior</a></li>";
            $links .= "<li class='page-item'><a href='?{$first}'>Primeira</a></li>";
        }

        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));

            $links .= "<li class='page-item'><a href='?{$linkPage}'>Proxima</a></li>";
            $links .= "<li class='page-item'><a href='?{$last}'>Ultima</a></li>";
        }


        $links .= '</ul>';
    }

}
