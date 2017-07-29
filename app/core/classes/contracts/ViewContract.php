<?php
namespace app\core\classes\contracts;

interface ViewContract
{

    public function getOutput();

    public function __toString();

}