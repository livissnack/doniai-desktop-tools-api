<?php

namespace App\Models;

use ManaPHP\Data\Db\Model;

/**
 * Class App\Models\BosObject
 */
class BosObject extends Model
{
    public $object_id;
    public $key;
    public $bucket_name;
    public $original_name;
    public $mime_type;
    public $extension;
    public $size;
    public $md5;
    public $ip;
    public $user_id;
    public $created_time;
    public $updated_time;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'bos_object';
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'object_id';
    }
}
