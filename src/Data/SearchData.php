<?php

namespace App\Data;

class SearchData
{
    private ?string $searchQuery = '';

    public function getSearchQuery(): ?string
    {
        return $this->searchQuery;
    }

    public function setSearchQuery(string $searchQuery): self
    {
        $this->searchQuery = $searchQuery;
        return $this;
    }
}
