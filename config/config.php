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
$definition
    ->setAutowired(true)
    ->setAutoconfigured(true)
    ->setBindings([
        '$allowedSlugs' => $container->getParameter('allowed_slugs'),
        '$allowedVersions' => $container->getParameter('allowed_versions'),
    ]);

$loader->registerClasses($definition, 'Ubi\\Deploy\\', __DIR__ . '/../src/');
$container->registerForAutoconfiguration(Filter::class)->addTag('ubi.deploy.filter');

$container->register(HttpClient::class, Client::class);

$container->getDefinition(Deploy::class)
    ->setPublic(true);


