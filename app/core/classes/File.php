<?php

namespace app\core\classes;


/**
 * Class File
 * @package app\core\classes
 */
class File
{

    /**
     * @var
     */
    private $root;

    /**
     * File constructor.
     * @param $root
     */
    public function __construct($root)
    {
        $this->root = $root;
    }

    /**
     * @param $file
     * @return bool
     */
    public function exists($file)
    {
        return file_exists($file);
    }

    /**
     * @param $file
     */
    public function call($file)
    {
        require $file;
    }

    /**
     * @param $path
     * @return string
     */
    public function to($path)
    {
        return $this->root . $path;
    }


}