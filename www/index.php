<?php
$dic = require __DIR__ . '/../app/bootstrap.php';
$dic->getByType('Nette\Application\Application')->run();
