<?php

require_once 'vendor\autoload.php';
require_once 'app\config\db_config.php';
require_once 'app\core\helpers.php';
require_once 'app\core\Application.php';
require_once 'app\core\classes\File.php';
require_once 'app\database.php';

use app\core\Application;
use app\core\classes\File;

$file = new File(__DIR__);

$app = Application::instantiate();
$app->init($file);
require_once 'app\routes.php';
echo '<pre>';
$app->run();

