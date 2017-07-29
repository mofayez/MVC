<?php

namespace app\core;

/**
 * Class Controller
 * @package app\core
 */
class Controller
{
    /**
     * @var Application
     */
    private $app;

    /**
     * Controller constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->app->get($name);
    }
}