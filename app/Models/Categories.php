<?php

namespace App\Models;

use ManaPHP\Data\Db\Model;

class Categories extends Model
{
    public $category_id;
    public $name;
    public $remark;
    public $created_at;
    public $updated_at;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'categories';
    }

    public function primaryKey()
    {
        return 'category_id';
    }
}
