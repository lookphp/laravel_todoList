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
    return view('tasks');
});

//增加新的任务
Route::post('/task',function(Request $request){

});

//删除一个已有的任务
Route::delete('/task/{id}',function($id){

});