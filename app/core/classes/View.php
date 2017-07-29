<?php

namespace classes;

use app\core\classes\File;
use app\core\classes\contracts\ViewContract;

class View implements ViewContract
{
    private $file;
    private $viewPath;
    private $data;
    private $output;

    public function __construct(File $file, $viewPath, array $data)
    {
        $this->file = $file;
        $this->preparePath($viewPath);
        $this->data = $data;
    }

    private function preparePath($viewPath)
    {
        $relativePath = '\\app\\views\\' . $viewPath . '.php';
        $this->viewPath = $this->file->to($relativePath);

        if (!$this->viewFileExists($relativePath)) die('<b>' . $viewPath . '</b> doesn\'t exist');
    }

    private function viewFileExists()
    {
        return $this->file->exists($this->viewPath);
    }

    public function __toString()
    {
        return (string)$this->getOutput();
    }

    public function getOutput()
    {
        if (!$this->output) {
            extract($this->data);
            require $this->viewPath;
        }
        return $this->output;
    }
}