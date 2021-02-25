<?php

namespace App\Models;

use ManaPHP\Data\Db\Model;

/**
 * Class App\Models\UserLoginLog
 */
class UserLoginLog extends Model
{
    public $log_id;
    public $user_id;
    public $user_name;
    public $ip;
    public $user_agent;
    public $created_date;
    public $created_time;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'user_login_log';
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'log_id';
    }
}
