<?php

namespace App\Models;

use ManaPHP\Data\Db\Model;

class Videos extends Model
{
    public $video_id;
    public $title;
    public $remark;
    public $cover_url;
    public $duration;
    public $play_nums;
    public $status;
    public $type;
    public $room_id;
    public $platform;
    public $is_crawler;
    public $url;
    public $category_id;
    public $created_at;
    public $updated_at;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'videos';
    }


    public function primaryKey()
    {
        return 'video_id';
    }
}
