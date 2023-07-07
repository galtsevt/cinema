<?php

namespace App\Services\Seo;

class MetaDataAccessor
{
    protected ?string $title = null;
    protected ?string $description = null;
    protected ?string $keywords = null;

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return MetaDataAccessor
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MetaDataAccessor
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return MetaDataAccessor
     */
    public function setKeywords(string $keywords): static
    {
        $this->keywords = $keywords;
        return $this;
    }


}
