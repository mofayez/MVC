<?php

namespace app\core;

class Controller
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function __get($name)
    {
        return $this->app->get($name);
    }
}