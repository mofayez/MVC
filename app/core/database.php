<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsual = new Capsule();

$capsual->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'mvc_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' =>'utf8_unicode_ci',
    'prefix' =>''
]);


$capsual->bootEloquent();
