<?php

require '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$config = require '../src/Config.php';

$routes = require '../src/Routes.php';

$dbManager = new Manager();
$dbManager->addConnection([
    'driver' => 'mysql',
    'host' => $config['DB_HOST'],
    'database' => $config['DB_DATABASE'],
    'username' => $config['DB_USER'],
    'password' => $config['DB_PASS'],
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => ''
]);

$dbManager->setAsGlobal();
$dbManager->bootEloquent();

$routes($app);

$app->run();