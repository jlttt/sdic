<?php

declare(strict_types = 1);

namespace Ubi\Deploy\Service;

use Http\Client\HttpClient;
use Ubi\Deploy\Entity\Cloud;

class CloudProvider
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        printf("%s::httpClient: %s\n", get_class(), get_class($this->httpClient));
    }

    public function get()
    {
        $clouds = [
            new Cloud('demo', '2.61'),
            new Cloud('dev', '2.56'),
            new Cloud('preprod', '2.62')
        ];
        shuffle($clouds);
        return $clouds;
    }
}
