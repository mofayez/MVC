<?php

namespace classes;
use app\core\Application;

/**
 * Class Route
 * @package classes
 */
class Route
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var array
     */
    private $routes = [];

    /**
     * Route constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $url
     * @param $action
     * @param string $requestMethod
     */
    public function addRoute($url, $action, $requestMethod = 'GET')
    {
        $route = [
            'url' => $url,
            'pattern' => $this->generatePattern($url),
            'action' => $this->getAction($action),
            'method' => $requestMethod
        ];

        $this->routes[] = $route;
    }

    /**
     * @param $url
     * @return string
     */
    private function generatePattern($url)
    {
        $pattern = "#^";
        $pattern .= preg_replace('(:[a-zA-Z0-9-]+)', '([a-zA-Z0-9-]+)', $url);
        $pattern .= '$#';

        return $pattern;
    }

    /**
     * @param $action
     * @return mixed|string
     */
    private function getAction($action)
    {
        $action = str_replace('/', '\\', $action);

        return strpos($action, '@') !== false ? $action : $action . '@index';
    }

    /**
     * @return array
     */
    public function getProperRoute()
    {
        foreach ($this->routes as $route) {
            if ($this->isMatching($route['pattern'])) {
                $arguments = $this->getArgumentsFrom($route['url']);
                list($controller, $method) = explode('@', $route['action']);
                return [$controller, $method, $arguments];
            }
        }
        die('<h3> the url <span style="color: red"> ' . $this->app->request->getUrl() . '</span> is not defined!</h3>');
    }

    /**
     * @param $pattern
     * @return int
     */
    private function isMatching($pattern)
    {
        return preg_match($pattern, $this->app->request->getUrl());
    }

    /**
     * @param $url
     * @return array
     */
    public function getArgumentsFrom($url)
    {
        $args = [];
        $requestUrl = explode('/', $this->app->request->getUrl());
        $url = explode('/', $url);
        $requestUrlLength = count($requestUrl);
        for ($i = 0; $i < $requestUrlLength; $i++) {
            if (preg_match('(:[a-zA-Z0-9-]+)', $url[$i])) {
                $args[str_replace(':', '', $url[$i])] = $requestUrl[$i];
            }
        }
        return $args;

    }
}