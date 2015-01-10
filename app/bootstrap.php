<?php

use Nette\Application\Routers\Route;

require __DIR__ . '/../vendor/autoload.php';


$configurator = new Nette\Configurator;
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->createRobotLoader()->addDirectory(__DIR__)->register();
$configurator->addConfig(__DIR__ . '/config.neon');
$configurator->addConfig(__DIR__ . '/config-local.neon');

$container = $configurator->createContainer();
$container->router[] = new Route('index.php', 'Demo:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>[/<action>][/<id>]', 'Demo:default');

return $container;
