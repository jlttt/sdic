<?php

namespace Ubi\Deploy\Entity;

class Cloud
{
    private $slug;
    private $version;

    public function __construct(string $slug, string $version)
    {
        $this->slug = $slug;
        $this->version = $version;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

}
