<?php

namespace classes;

use app\core\Application;

class Session
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function start()
    {
        ini_set('session.use_only_cookies', 1);
        if (!session_id()) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        echo $key . ' => ' . $value;
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function pull($key)
    {
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }

    public function all()
    {
        return $_SESSION;
    }

    public function destroy()
    {
        session_destroy();
        unset($_SESSION);
    }
}