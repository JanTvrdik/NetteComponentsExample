<?php

/**
 * Test: Nette\Loaders\NetteLoader basic usage.
 */

use Tester\Assert;


require __DIR__ . '/../../vendor/nette/tester/Tester/bootstrap.php';
require __DIR__ . '/../../src/Loaders/NetteLoader.php';


Assert::false( class_exists('Nette\Environment') );

Nette\Loaders\NetteLoader::getInstance()->register();

Assert::true( class_exists('Nette\Environment') );


require __DIR__ . '/../bootstrap.php';

Assert::error(function() {
	class_exists('Nette\Http\User');
}, E_USER_WARNING, 'Class Nette\Http\User has been renamed to Nette\Security\User.');
