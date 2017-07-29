<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $name = User::all()->first()->username;
        $this->view->render('index', compact('name'));
    }
}