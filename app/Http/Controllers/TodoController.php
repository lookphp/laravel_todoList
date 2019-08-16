<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /**
     * 认证所有的任务路由,让其仅限已认证的用户访问。
     * 使用中间件实现，so easy
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 显示用户所有任务清单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $todos = Todo::where('user_id',$request->user()->id)->get();
        return view('todos.index',[
            'todos' => $todos,
        ]);
    }

    public function store(Request $request)
    {
        //和路由里的验证不一样
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $request->user()->todos()->create([
            'name' => $request->name,
        ]);

        return redirect('/todos');
    }
}
