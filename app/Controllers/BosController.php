<?php

namespace App\Controllers;

use App\Models\BosObject;
use ManaPHP\Rest\Controller;
use App\Services\AliyunOssService;

class BosController extends Controller
{
    public function putAction()
    {
        $file = $this->request->getFile();
        if (!is_file($file->getTempName())) {
            return '上传文件异常';
        }

        $ext_name = $file->getExtension();
        $bucket_name = param_get('ali_oss_bucket_name');
        $target = path("@tmp/uploads/{$bucket_name}/{$file->getName()}");

        $file->moveTo($target, 'jpg,jpeg,png,gif', true);
        $content_type = 'image/' . $ext_name;
        $filename = $file->getName();
        AliyunOssService::publicUpload($bucket_name, $filename, $target, ['ContentType' => $content_type]);
        unlink($target);
        $url = AliyunOssService::getPublicObjectURL($bucket_name, $filename);
        return ['code' => 0, 'data' => ['url' => $url], 'message' => '上传成功'];
    }

    public function delAction()
    {
        $oss_key = input('key', ['string']);

        try {
            $bucket_name = param_get('ali_oss_bucket_name');
            AliyunOssService::publicDeleteObject($bucket_name, $oss_key);
            return ['code' => 0, 'message' => '删除成功'];
        } catch (\Throwable $throwable) {
            return '删除失败';
        }
    }

    public function indexAction()
    {
        $user_id = $this->identity->getId();
        if ($user_id < 1) {
            return '未登录';
        }
        return BosObject::search(['extension'])->where(['user_id' => $user_id])->orderBy(['created_time' => SORT_DESC])->paginate();
    }
}
