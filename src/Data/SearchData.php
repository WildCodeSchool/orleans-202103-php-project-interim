<?php

namespace App\Data;

class SearchData
{
    private ?string $searchQuery = '';

    /**
     * Get the value of searchQuery
     */
    public function getSearchQuery(): ?string
    {
        return $this->searchQuery;
    }

    /**
     * Set the value of searchQuery
     *
     * @return  self
     */
    public function setSearchQuery(?string $searchQuery)
    {
        $this->searchQuery = $searchQuery;
        return $this;
    }
}
