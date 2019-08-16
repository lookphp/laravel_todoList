<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TodoRepository;

class TodoController extends Controller
{
    /**
     * 任务资源库的实例
     * @var TodoRepository
     */
    protected $todos;

    /**
     * 认证所有的任务路由,让其仅限已认证的用户访问。
     * 使用中间件实现，so easy
     *
     * 使用资源库，创建新的控制器实例
     */
    public function __construct(TodoRepository $todos)
    {
        $this->middleware('auth');

        $this->todos = $todos;
    }

    /**
     * 显示用户所有任务清单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('todos.index',[
            'todos' => $this->todos->forUser($request->user()),
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

    public function destory(Request $request,Todo $todo)
    {
        $this->authorize('destory',$todo);

        $todo->delete();

        return redirect('/todos');
    }
}
