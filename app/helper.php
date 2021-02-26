<?php

if (!function_exists('redirect_url')) {
    function redirect_url($url, $referer = '', $timeout = 10)
    {
        $redirect_url = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: */*',
            'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
            'Connection: Keep-Alive']);
        if ($referer) {
            curl_setopt($ch, CURLOPT_REFERER, $referer);//设置referer
        }
        curl_exec($ch);
        if (!curl_errno($ch)) {
            $redirect_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);//获取最终请求的url地址
        }
        return $redirect_url;
    }
}
