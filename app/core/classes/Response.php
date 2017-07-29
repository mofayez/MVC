<?php

namespace classes;

use app\core\Application;


class Response
{
    private $app;
    private $headers = [];
    private $content = '';

    private function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function setHeaders($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function setOutput($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendOutput();
    }

    private function sendHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header . ':' . $value);
        }
    }

    private function sendOutput()
    {
        echo $this->content;
    }


}