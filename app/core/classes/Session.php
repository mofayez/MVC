<?php

namespace classes;

use app\core\Application;

/**
 * Class Session
 * @package classes
 */
class Session
{
    /**
     * @var Application
     */
    private $app;

    /**
     * Session constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     *
     */
    public function start()
    {
        ini_set('session.use_only_cookies', 1);
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function pull($key)
    {
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $_SESSION;
    }

    /**
     *
     */
    public function destroy()
    {
        session_destroy();
        unset($_SESSION);
    }
}
