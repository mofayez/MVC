<?php

namespace classes;
use app\core\Application;

class Route
{
    private $app;
    private $routes = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

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

    private function generatePattern($url)
    {
        $pattern = "#^";
        $pattern .= preg_replace('(:[a-zA-Z0-9-]+)', '([a-zA-Z0-9-]+)', $url);
        $pattern .= '$#';

        return $pattern;
    }

    private function getAction($action)
    {
        $action = str_replace('/', '\\', $action);

        return strpos($action, '@') !== false ? $action : $action . '@index';
    }

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

    private function isMatching($pattern)
    {
        return preg_match($pattern, $this->app->request->getUrl());
    }

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