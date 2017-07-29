<?php

namespace classes;

use app\core\Application;


/**
 * Class Response
 * @package classes
 */
class Response
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var array
     */
    private $headers = [];
    /**
     * @var string
     */
    private $content = '';

    /**
     * Response constructor.
     * @param Application $app
     */
    private function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $header
     * @param $value
     */
    public function setHeaders($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * @param $content
     */
    public function setOutput($content)
    {
        $this->content = $content;
    }

    /**
     *
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendOutput();
    }

    /**
     *
     */
    private function sendHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header . ':' . $value);
        }
    }

    /**
     *
     */
    private function sendOutput()
    {
        echo $this->content;
    }


}