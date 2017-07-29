<?php

namespace app\core\classes;


class File
{

    private $root;

    public function __construct($root)
    {
        $this->root = $root;
    }

    public function exists($file)
    {
        return file_exists($file);
    }

    public function call($file)
    {
        require $file;
    }

    public function to($path)
    {
        return $this->root . $path;
    }


}