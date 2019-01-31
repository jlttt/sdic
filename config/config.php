<?php
use Symfony\Component\DependencyInjection\Definition;

use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;

use Ubi\Deploy\Deploy;

$definition = new Definition();
$definition->setAutowired(true);

$loader->registerClasses($definition, 'Ubi\\Deploy\\', __DIR__ . '/../src/');
$container->register(HttpClient::class, Client::class);
$container->getDefinition(Deploy::class)
    ->setPublic(true);