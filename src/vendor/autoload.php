<?php
require_once __DIR__ .'/autoloader/ClassLoader.php';
require_once __DIR__ .'/mikecao/flight/Flight.php';
$autoload = new \autoloader\ClassLoader();
$autoload->addPsr4('KlikFlight\\', dirname(__DIR__));
$autoload->addPsr4('flight\\', __DIR__.'/mikecao/flight/');
/*$mapper = new \autoloader\ClassMapper(__DIR__. '');
$mapper->writeToFile(__DIR__.'/ClassMap.php');
return $autoload;*/