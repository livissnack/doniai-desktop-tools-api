<?php

namespace App\Controllers;

use ManaPHP\Rest\Controller;

class CoinController extends Controller
{
    public function multiPriceAction()
    {
        $fsyms = input('fsyms', ['string', 'default' => 'BTC,ETH,XMR']);
        $tsyms = input('tsyms', ['string', 'default' => 'USD,CNY']);
        $url = env('CRYPTO_COMPARE_API_URL').'/data/pricemulti?'.http_build_query(['fsyms' => $fsyms, 'tsyms' => $tsyms]);
        $key = env('CRYPTO_COMPARE_API_KEY');
        return http_get($url, ['Authorization' => 'Apikey '.$key])->body;
    }
}
