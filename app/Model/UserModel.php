<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //指派表名
    protected $table='p_users';

    /**
     * 默认使用时间戳戳功能
     *
     * @var bool
     */
    public $timestamps = true;
}
