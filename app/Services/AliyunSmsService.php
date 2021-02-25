<?php

namespace App\Services;

use ManaPHP\Service;

class AliyunSmsService extends Service
{
    protected $_access_key_id;
    protected $_access_key_secret;
    protected $_sms_sign_name;

    const ENDPOINT_URL = 'https://dysmsapi.aliyuncs.com/?';
    const ENDPOINT_METHOD = 'SendSms';
    const ENDPOINT_VERSION = '2017-05-25';
    const ENDPOINT_FORMAT = 'JSON';
    const ENDPOINT_REGION_ID = 'cn-hangzhou';
    const ENDPOINT_SIGNATURE_METHOD = 'HMAC-SHA1';
    const ENDPOINT_SIGNATURE_VERSION = '1.0';

    /**
     * @param $mobile
     * @param $templateCode //SMS_181310422: 用户注册验证码，SMS_181310421: 修改密码验证码，SMS_181310424: 登录确认验证码，SMS_181310423: 登录异常验证码，用户找回密码：SMS_181211976
     * @param $data
     * @return array|mixed|string
     */
    public function send($mobile, $templateCode, $data)
    {
        $signName = !empty($data['sign_name']) ? $data['sign_name'] : $this->_sms_sign_name;
        unset($data['sign_name']);
        $params = [
            'RegionId' => self::ENDPOINT_REGION_ID,
            'AccessKeyId' => $this->_access_key_id,
            'Format' => self::ENDPOINT_FORMAT,
            'SignatureMethod' => self::ENDPOINT_SIGNATURE_METHOD,
            'SignatureVersion' => self::ENDPOINT_SIGNATURE_VERSION,
            'SignatureNonce' => uniqid(),
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'Action' => self::ENDPOINT_METHOD,
            'Version' => self::ENDPOINT_VERSION,
            'PhoneNumbers' => $mobile,
            'SignName' => $signName,
            'TemplateCode' => $templateCode,
            'TemplateParam' => json_encode($data, JSON_FORCE_OBJECT),
        ];
        $params['Signature'] = $this->generateSign($params);
        $params[] = self::ENDPOINT_URL;
        $result = http_get($params)->body;
        if ('OK' !== $result['Code']) {
            return $result['Message'];
        }
        return $result;
    }

    /**
     * @param $params
     * @return string
     */
    protected function generateSign($params)
    {
        ksort($params);
        $accessKeySecret = $this->_access_key_secret;
        $stringToSign = 'GET&%2F&' . urlencode(http_build_query($params, null, '&', PHP_QUERY_RFC3986));
        return base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret . '&', true));
    }
}