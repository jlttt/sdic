<?php

namespace Ubi\Deploy\Service;

use Ubi\Deploy\Entity\Cloud;

interface Filter
{
    public function applyTo(Cloud ...$clouds): array;
}
