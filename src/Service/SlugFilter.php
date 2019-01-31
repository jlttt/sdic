<?php

namespace Ubi\Deploy\Service;

use Ubi\Deploy\Entity\Cloud;

class SlugFilter implements Filter
{
    private $allowedSlugs;

    public function __construct(array $allowedSlugs)
    {
        $this->allowedSlugs = $allowedSlugs;
    }

    public function applyTo(Cloud ...$clouds): array
    {
        $filteredClouds = [];
        foreach ($clouds as $cloud) {
            if ($this->isSatisfiedBy($cloud)) {
                $filteredClouds[] = $cloud;
            }
        }
        return $filteredClouds;
    }

    private function isSatisfiedBy(Cloud $cloud)
    {
        return in_array($cloud->getSlug(), $this->allowedSlugs);
    }
}
