<?php

namespace classes;

use app\core\classes\File;
use app\core\classes\contracts\ViewContract;

/**
 * Class View
 * @package classes
 */
class View implements ViewContract
{
    /**
     * @var File
     */
    private $file;
    /**
     * @var
     */
    private $viewPath;
    /**
     * @var array
     */
    private $data;
    /**
     * @var
     */
    private $output;

    /**
     * View constructor.
     * @param File $file
     * @param $viewPath
     * @param array $data
     */
    public function __construct(File $file, $viewPath, array $data)
    {
        $this->file = $file;
        $this->preparePath($viewPath);
        $this->data = $data;
    }

    /**
     * @param $viewPath
     */
    private function preparePath($viewPath)
    {
        $relativePath = '\\app\\views\\' . $viewPath . '.php';
        $this->viewPath = $this->file->to($relativePath);

        if (!$this->viewFileExists($relativePath)) die('<b>' . $viewPath . '</b> doesn\'t exist');
    }

    /**
     * @return bool
     */
    private function viewFileExists()
    {
        return $this->file->exists($this->viewPath);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getOutput();
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        if (!$this->output) {
            extract($this->data);
            require $this->viewPath;
        }
        return $this->output;
    }
}