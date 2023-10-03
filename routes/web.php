<?php

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\ServerMonitor\ServerMonitor;
use App\Http\Controllers\User\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::post('/notification-read/', [UserController::class, 'notificationRead']);
Auth::routes(['register'=>false , 'reset' => false]);

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('roles', RoleController::class)->except([
        'show'
    ]);
    Route::resource('users', UserController::class)->except([
        'show',
        'edit',
        'update'
    ]);
});

Route::get('/users/{user}/edit',[UserController::class, 'edit'])
    ->middleware(['auth', 'sameuser'])
    ->name('users.edit');
Route::put('/users/{user}',[UserController::class, 'update'])
    ->middleware(['auth', 'sameuser'])
    ->name('users.update');


Route::middleware(['auth:web'])->group(function(){

//    Route::get('/test', function () {
//        return view('test', compact('projects', 'user'));
//    });
    Route::resource('informer', ProjectController::class)
        ->parameters(['informer' => 'project']);
    Route::post('/informer/restore/{project}',[ProjectController::class, 'restore'])
        ->name('informer.restore');
    Route::post('/informer/chosen/{project}',[ProjectController::class, 'chosen'])
        ->name('informer.chosen');
    Route::post('/informer/getsftpaccount',[ProjectController::class, 'getSftpAccount'])
        ->name('informer.getsftpaccount');
    Route::post('/informer/getallaccounts',[ProjectController::class, 'getAllAccounts'])
        ->name('informer.getallaccounts');

    Route::resource('post', PostController::class)
        ->except([
            'create',
            'edit',
            'show'
        ]);
    Route::get('/post/create/{project}',[PostController::class, 'create'])
        ->name('post.create');
    Route::get('/post/{post}/edit',[PostController::class, 'edit'])
        ->name('post.edit');
    Route::post('/post/restore/{post}',[PostController::class, 'restore'])
        ->name('post.restore');
    Route::post('/post/upload',[PostController::class, 'uploadImg'])
        ->name('post.upload');
    Route::get('/search/',[PostController::class, 'search'])
        ->name('post.search');

    Route::get('/post/comment/{post}', [CommentController::class, 'create'])
        ->name('comment.create');
    Route::get('/post/comment/{comment}/edit', [CommentController::class, 'edit'])
        ->name('comment.edit');
    Route::post('/post/comment', [CommentController::class, 'store'])
        ->name('comment.store');
    Route::put('/post/comment/{comment}', [CommentController::class, 'update'])
        ->name('comment.update');
    Route::delete('/post/comment/{comment}', [CommentController::class, 'destroy'])
        ->name('comment.destroy');


    Route::match(['put', 'post'],'/project/monitoring/checkSshConnection/{project_monitoring?}',[ServerMonitor::class, 'checkSshConnection'])
        ->name('monitoring.checkSshConnection');


    Route::get('/project/monitoring/{project}',[ServerMonitor::class, 'create'])
        ->name('monitoring.create');
    Route::get('/project/monitoring/{project_monitoring}/show',[ServerMonitor::class, 'show'])
        ->name('monitoring.show');
    Route::post('/project/monitoring/',[ServerMonitor::class, 'store'])
        ->name('monitoring.store');
    Route::get('/project/monitoring/{project_monitoring}/edit',[ServerMonitor::class, 'edit'])
        ->name('monitoring.edit');
    Route::put('/project/monitoring/{project_monitoring}',[ServerMonitor::class, 'update'])
        ->name('monitoring.update');



});

//Исправляем бред с созданием симлинка на storage при развертывании в новой системе docker\сервер
Route::get('/storage', function () {
    Artisan::call('storage:link');
});
Route::fallback(function () {
    return abort(404);
});


