<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Task;
use Illuminate\Http\Request;

//Route::get('/', function () {
//    return view('welcome');
//});

//显示所有任务
Route::get('/',function(){
    $tasks = Task::orderBy('created_at','desc')->get();
    return view('tasks',[
        'tasks' => $tasks
    ]);
});

//增加新的任务
Route::post('/task',function(Request $request){
    $validator = Validator::make($request->all(),[
       'name' => 'required|max:255',
    ]);

    if($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

//删除一个已有的任务
Route::delete('/task/{id}',function($id){
    Task::findOrFail($id)->delete();
    return redirect('/');
});

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');   //需要确认下模板的请求地址是否为/auth/login
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//待办路由
Route::get('/todos','TodoController@index');
Route::post('/todo','TodoController@store');
Route::delete('/todo/{todo}','TodoController@destory');