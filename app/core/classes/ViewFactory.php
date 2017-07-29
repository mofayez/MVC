<?php
namespace classes;

use app\core\Application;

/**
 * Class ViewFactory
 * @package classes
 */
class ViewFactory
{
    /**
     * @var Application
     */
    private $app;

    /**
     * ViewFactory constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $viewPath
     * @param array $args
     */
    public function render($viewPath, $args = [])
    {
        echo new View($this->app->file, $viewPath, $args);
    }

}