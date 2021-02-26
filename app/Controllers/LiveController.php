<?php

namespace App\Controllers;

use App\Models\Videos;
use App\Models\Categories;
use ManaPHP\Rest\Controller;

class LiveController extends Controller
{
    public function indexAction()
    {
        return Videos::search(['category_id'])->select(['video_id', 'title', 'remark', 'cover_url', 'play_nums', 'url', 'category_id', 'type'])
            ->where(['status' => 0])->all();
    }

    public function detailAction()
    {
        $video_id = input('video_id', ['int']);
        return Videos::select(['video_id', 'title', 'remark', 'cover_url', 'play_nums', 'url', 'type'])->where(['video_id' => $video_id, 'status' => 0])->first();
    }

    public function hotAction()
    {
        $video_id = input('video_id', ['int']);
        $category_id = Videos::value(['video_id' => $video_id], 'category_id');
        return Videos::select(['video_id', 'title', 'remark', 'cover_url', 'play_nums', 'url', 'category_id', 'type'])
            ->where(['category_id' => $category_id, 'status' => 0])->limit(20);
    }

    public function categoriesAction()
    {
        return Categories::select(['category_id', 'name'])->all();
    }
}
