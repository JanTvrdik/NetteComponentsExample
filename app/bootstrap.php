<?php

use Nette\Application\Routers\Route;

require LIBS_DIR . '/Nette/loader.php';


$configurator = new Nette\Config\Configurator;
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->createRobotLoader()->addDirectory(array(APP_DIR, LIBS_DIR))->register();
$configurator->addConfig(__DIR__ . '/config.neon');

$container = $configurator->createContainer();
$container->router[] = new Route('index.php', 'Demo:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>[/<action>][/<id>]', 'Demo:default');
$container->application->run();
