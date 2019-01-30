<?php

declare(strict_types = 1);

namespace Ubi\Deploy;

use Ubi\Deploy\Service\CloudProvider;
use Ubi\Deploy\Service\JenkinsManager;

class Deploy
{
    private $cloudProvider;
    private $jenkinsManager;

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
        $cloud = reset($clouds);
        $this->jenkinsManager->deploy($cloud);
    }
}

