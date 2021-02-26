<?php

namespace App\Controllers;

use ManaPHP\Rest\Controller;

class ParseController extends Controller
{
    public function douyinAction()
    {
        $target_url = input('url', ['string', 'default' => 'https://v.douyin.com/JFmwXkr']);
        $response = http_get($target_url, [
            'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1'
        ])->body;
        return $response;
    }
}
