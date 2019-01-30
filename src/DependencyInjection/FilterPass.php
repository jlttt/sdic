<?php

namespace Ubi\Deploy\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use Ubi\Deploy\Deploy;

class FilterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $deployDefinition = $container->getDefinition(Deploy::class);
        $filters = $container->findTaggedServiceIds('ubi.deploy.filter');
        foreach ($filters as $serviceId => $tagAttributes) {
            $deployDefinition->addMethodCall('addFilter', [new Reference($serviceId)]);
        }
    }
}
