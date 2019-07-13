<?php

use App\Services\Twitter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * GET   /projects (index)
 * GET   /projects/create (create)
 * GET   /projects/1 (show)
 * GET   /projects/1/edit (edit)
 * POST  /projects (store)
 * PATCH /projects/1 (update)
 * DELET /projects/1 (destroy)
 */

Route::resource('projects', 'ProjectsController')->middleware('can:update,project');
// Route::resource('projects', 'ProjectsController');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
