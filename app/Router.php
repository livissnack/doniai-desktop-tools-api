<?php

namespace App;

class Router extends \ManaPHP\Http\Router
{
    public function __construct()
    {
        $this->_prefix = '/api';

        parent::__construct(true);

        $this->setAreas();

        $this->add('/', 'test::index');
    }
}
