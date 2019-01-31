<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;

use Ubi\Deploy\Deploy;
use Ubi\Deploy\Service\SlugFilter;
use Ubi\Deploy\Service\VersionFilter;

$definition = new Definition();
$definition->setAutowired(true);

$loader->registerClasses($definition, 'Ubi\\Deploy\\', __DIR__ . '/../src/');
$container->register(HttpClient::class, Client::class);
$container->getDefinition(SlugFilter::class)
    ->addArgument('%allowed_slugs%')
    ->setPublic(true);
$container->getDefinition(VersionFilter::class)
    ->addArgument('%allowed_versions%')
    ->setPublic(true);
$container->getDefinition(Deploy::class)
    ->addMethodCall('addFilter', [new Reference(VersionFilter::class)])
    ->addMethodCall('addFilter', [new Reference(SlugFilter::class)])
    ->setPublic(true);


