<?php

declare(strict_types = 1);

namespace Ubi\Deploy\Service;

use Http\Client\HttpClient;
use Ubi\Deploy\Entity\Cloud;

class JenkinsManager
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        printf("%s::httpClient: %s\n", get_class(), get_class($this->httpClient));
    }

    public function deploy(Cloud $cloud)
    {
        printf("Deploy cloud %s to %s\n", $cloud->getSlug(), $cloud->getVersion());
    }
}