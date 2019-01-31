<?php
use Symfony\Component\DependencyInjection\Definition;

use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;

use Ubi\Deploy\Deploy;
use Ubi\Deploy\Service\SlugFilter;
use Ubi\Deploy\Service\VersionFilter;

$definition = new Definition();
$definition->setAutowired(true);

$loader->registerClasses($definition, 'Ubi\\Deploy\\', __DIR__ . '/../src/');
$container->register(HttpClient::class, Client::class);
$container->getDefinition(Deploy::class)
    ->setPublic(true);
$container->getDefinition(SlugFilter::class)
    ->addArgument('%allowed_slugs%')
    ->setPublic(true);
$container->getDefinition(VersionFilter::class)
    ->addArgument('%allowed_versions%')
    ->setPublic(true);

