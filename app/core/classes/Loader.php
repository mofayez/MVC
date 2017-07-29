<?php
namespace classes;

use app\core\Application;

/**
 * Class Loader
 * @package classes
 */
class Loader
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var array
     */
    private $controllers = [];

    /**
     * Loader constructor.
     * @param $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $controller
     * @param $method
     * @param null $args
     * @return mixed
     */
    public function action($controller, $method, $args = null)
    {
        $object = $this->controller($controller);
        return call_user_func_array([$object, $method], $args);
    }

    /**
     * @param $controller
     * @return mixed
     */
    public function controller($controller)
    {
        if (!$this->hasController($controller)) {
            $this->addController($controller);
        }

        return $this->getController($controller);
    }

    /**
     * @param $controller
     * @return bool
     */
    public function hasController($controller)
    {
        return array_key_exists($controller, $this->controllers);
    }

    /**
     * @param $controller
     */
    public function addController($controller)
    {
        $_controller = 'app\\controllers\\' . $controller;

        $object = new $_controller($this->app);
        $this->controllers[$controller] = $object;
    }

    /**
     * @param $controller
     * @return mixed
     */
    public function getController($controller)
    {
        return $this->controllers[$controller];
    }


}