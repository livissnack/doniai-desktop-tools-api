<?php

namespace App\Controllers;

use ManaPHP\Rest\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return 'hello world';
    }
}
