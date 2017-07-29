<?php
/**
 * Created by PhpStorm.
 * User: Muhammad
 * Date: 7/19/2017
 * Time: 12:57 PM
 */

namespace app\core;

use app\core\classes\File;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    /**
     * @var null
     */
    private static $instance = null;
    /**
     * @var array
     */
    private $container = [];

    /**
     * Application constructor.
     */
    private function __construct()
    {

    }

    /**
     * @return Application|null
     */
    public static function instantiate()
    {
        if (self::$instance === null) {
            self::$instance = new self();
            return self::$instance;
        }
        require self::$instance;
    }

    /**
     * @param File $file
     */
    public function init(File $file)
    {
        $this->share('file', $file);
        $this->registerClasses();
    }

    /**
     * @param $key
     * @param $value
     */
    private function share($key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     *
     */
    private function registerClasses()
    {
        spl_autoload_register([$this, 'load']);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->isShared($key)) {
            if ($this->isCoreAlias($key)) {
                $this->share($key, $this->createNewCoreObject($key));
            } else {
                die('<b>' . $key . '</b> is not found in the app container');
            }
        }

        return $this->container[$key];
    }

    /**
     * @param $key
     * @return bool
     */
    private function isShared($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * @param $alias
     * @return bool
     */
    private function isCoreAlias($alias)
    {
        $coreClasses = $this->getCoreClasses();
        return isset($coreClasses[$alias]);
    }

    /**
     * @return array
     */
    private function getCoreClasses()
    {
        return [
            'request' => 'classes\\Request',
            'response' => 'classes\\Response',
            'session' => 'classes\\Session',
            'cookie' => 'classes\\Cookie',
            'load' => 'classes\\Loader',
            'html' => 'classes\\Html',
            'db' => 'classes\\Database',
            'view' => 'classes\\ViewFactory',
            'route' => 'classes\\Route',
        ];
    }

    /**
     * @param $alias
     * @return mixed
     */
    private function createNewCoreObject($alias)
    {
        $coreClasses = $this->getCoreClasses();
        $object = $coreClasses[$alias];
        return new $object($this);
    }

    /**
     *
     */
    public function run()
    {
        $this->session->start();
        $this->db->connect();
        $this->request->prepareUrl();
        list($controller, $method, $args) = $this->route->getProperRoute();
        $this->load->action($controller, $method, $args);
    }

    /**
     * @param $class
     */
    protected function load($class)
    {
        $file = $this->file->to('\\app\\core\\' . $class . '.php');

        if ($this->file->exists($file)) {
            $this->file->call($file);
        }

    }

    /**
     *
     */
    private function __clone()
    {

    }


}