<?php

namespace ManaPHP\Http;

interface CaptchaInterface
{
    /**
     * @param int $width
     * @param int $height
     * @param int $ttl
     *
     * @return \ManaPHP\Http\ResponseInterface
     */
    public function generate($width = 100, $height = 30, $ttl = 300);

    /**
     * @param string $code
     * @param bool   $isTry
     *
     * @return void
     * @throws \ManaPHP\Http\Captcha\InvalidCaptchaException
     */
    public function verify($code = null, $isTry = false);
}