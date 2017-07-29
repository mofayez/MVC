<?php

namespace classes;

use app\core\Application;

/**
 * Class Request
 * @package classes
 */
class Request
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $baseUrl;

    /**
     * Request constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        return ($key) ? $_GET[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function post($key, $default = null)
    {
        return ($key) ? $_POST[$key] : $default;
    }

    /**
     * @return null
     */
    public function getMethod()
    {
        return $this->getServerProperty('REQUEST_METHOD');
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function getServerProperty($key, $default = null)
    {
        return $key ? $_SERVER[$key] : $default;
    }

    /**
     *
     */
    public function prepareUrl()
    {
        $requestUrl = str_replace('/dashboard/my_apps/study_projects/MVC/', '', $this->getServerProperty('REQUEST_URI'));
        $baseUrl = $this->getServerProperty('REQUEST_SCHEME') . '://' . $this->getServerProperty('SERVER_NAME') . '/my_apps/MVC/';

        $this->url = $requestUrl;
        $this->baseUrl = $baseUrl;
    }
}
