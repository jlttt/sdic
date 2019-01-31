<?php

namespace Ubi\Deploy\Service;

use Ubi\Deploy\Entity\Cloud;

class VersionFilter implements Filter
{
    private $allowedVersions;

    public function __construct(array $allowedVersions)
    {
        $this->allowedVersions = $allowedVersions;
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
        return in_array($cloud->getVersion(), $this->allowedVersions);
    }
}
