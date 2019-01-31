<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;

use Ubi\Deploy\Deploy;
use Ubi\Deploy\Service\SlugFilter;
use Ubi\Deploy\Service\VersionFilter;
use Ubi\Deploy\Service\Filter;

$definition = new Definition();
$definition->setAutowired(true);
$definition->setAutoconfigured(true);
$definition->setPublic(false);

$loader->registerClasses($definition, 'Ubi\\Deploy\\', __DIR__ . '/../src/');
$container->registerForAutoconfiguration(Filter::class)->addTag('ubi.deploy.filter');

$container->register(HttpClient::class, Client::class);

$container->getDefinition(SlugFilter::class)
    ->addArgument('%allowed_slugs%');

$container->getDefinition(VersionFilter::class)
    ->addArgument('%allowed_versions%');

$container->getDefinition(Deploy::class)
    ->setPublic(true);


