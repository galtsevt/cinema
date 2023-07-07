<?php

namespace App\Services\Seo;

class Breadcrumb
{
    private ?string $url = null;
    private string $name;

    public function __construct(string $name, string $url = null)
    {
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url == 0 ? null:$this->url;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
