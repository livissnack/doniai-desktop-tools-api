<?php

namespace App\Controllers;

use ManaPHP\Rest\Controller;

class MemberController extends Controller
{
    public function indexAction()
    {
        return t('news');
    }
}
