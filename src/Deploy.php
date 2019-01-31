<?php

declare(strict_types = 1);

namespace Ubi\Deploy;

use Ubi\Deploy\Service\CloudProvider;
use Ubi\Deploy\Service\Filter;
use Ubi\Deploy\Service\JenkinsManager;

class Deploy
{
    private $cloudProvider;
    private $jenkinsManager;
    private $filters = [];

    public function __construct(
        CloudProvider $cloudProvider,
        JenkinsManager $jenkinsManager
    )
    {
        $this->cloudProvider = $cloudProvider;
        $this->jenkinsManager = $jenkinsManager;
        printf("%s::cloudProvider: %s\n", get_class(), get_class($this->cloudProvider));
        printf("%s::jenkinsManager: %s\n", get_class(), get_class($this->jenkinsManager));
    }

    public function run() {
        $clouds = $this->cloudProvider->get();
        foreach($this->filters as $filter) {
            $clouds = $filter->applyTo(...$clouds);
        }
        $cloud = reset($clouds);
        $this->jenkinsManager->deploy($cloud);
    }

    public function addFilter(Filter $filter) {
        $this->filters[] = $filter;
    }
}

