<?php

namespace App\Policies;

use App\User;
use App\Todo;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 判断指定用户是否可以删除指定的任务
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function destory(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
