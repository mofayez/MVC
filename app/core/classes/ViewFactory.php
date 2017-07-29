<?php
namespace classes;

use app\core\Application;

class ViewFactory
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function render($viewPath, $args = [])
    {
        echo new View($this->app->file, $viewPath, $args);
    }

}