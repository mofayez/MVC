<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsual = new Capsule();

$capsual->addConnection([
    'driver' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',
    'collation' =>'utf8_unicode_ci',
    'prefix' =>''
]);


$capsual->bootEloquent();
