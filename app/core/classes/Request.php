<?php

namespace classes;

use app\core\Application;

class Request
{
    private $app;
    private $url;
    private $baseUrl;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function get($key, $default = null)
    {
        return ($key) ? $_GET[$key] : $default;
    }

    public function post($key, $default = null)
    {
        return ($key) ? $_POST[$key] : $default;
    }

    public function getMethod()
    {
        return $this->getServerProperty('REQUEST_METHOD');
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getServerProperty($key, $default = null)
    {
        return $key ? $_SERVER[$key] : $default;
    }

    public function prepareUrl()
    {
        $requestUrl = str_replace('/dashboard/my_apps/study_projects/MVC/', '', $this->getServerProperty('REQUEST_URI'));
        $baseUrl = $this->getServerProperty('REQUEST_SCHEME') . '://' . $this->getServerProperty('SERVER_NAME') . '/my_apps/MVC/';

        $this->url = $requestUrl;
        $this->baseUrl = $baseUrl;
    }
}
