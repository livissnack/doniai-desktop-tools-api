<?php

namespace App\Models;

use ManaPHP\Data\Db\Model;

/**
 * Class App\Models\BosBucket
 */
class BosBucket extends Model
{
    public $bucket_id;
    public $bucket_name;
    public $bucket_key;
    public $bucket_secret;
    public $base_url;
    public $user_id;
    public $created_time;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'bos_bucket';
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'bucket_id';
    }
}
