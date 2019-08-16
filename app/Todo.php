<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * 这些属性能被批量赋值
     */
    protected $fillable = ['name'];

    /**
     * 获取拥有此任务的用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
