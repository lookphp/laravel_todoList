<?php

namespace App\Repositories;

use App\User;
use App\Todo;

/**
 * 创建资源库
 * Class TaskRepository
 * @package App\Repositories
 */
class TodoRepository
{
    /**
     * 获取指定用户的所有任务。
     * @param User $user
     * @return mixed
     */
    public function forUser(User $user)
    {
        return Todo::where('user_id',$user->id)
            ->orderBy('created_at','asc')
            ->get();
    }
}