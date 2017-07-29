<?php
namespace classes;

use app\core\Application;

class Loader
{
    private $app;
    private $controllers = [];

    /**
     * Loader constructor.
     * @param $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function action($controller, $method, $args = null)
    {
        $object = $this->controller($controller);
        return call_user_func_array([$object, $method], $args);
    }

    public function controller($controller)
    {
        if (!$this->hasController($controller)) {
            $this->addController($controller);
        }

        return $this->getController($controller);
    }

    public function hasController($controller)
    {
        return array_key_exists($controller, $this->controllers);
    }

    public function addController($controller)
    {
        $_controller = 'app\\controllers\\' . $controller;
//        require 'C:\\xampp\\htdocs\\dashboard\\my_apps\\study_projects\\MVC\\app\\controllers\\' . $controller . '.php';
        $object = new $_controller($this->app);
        $this->controllers[$controller] = $object;
    }

    public function getController($controller)
    {
        return $this->controllers[$controller];
    }


}