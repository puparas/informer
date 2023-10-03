<?php


use App\Http\Controllers\Auth\AuthController;
use App\Http\Resources\PostCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('refresh', 'refresh');
});
Route::middleware('auth:api')->prefix('project')->group(function () {
    Route::get('getProjectByUrl', function () {
        $host = prepareUrlForUse(request('url'));
        if(Project::where('url', 'LIKE', '%' . $host . '%')->count()){
            return new ProjectResource(Project::where('url', 'LIKE', '%' . $host . '%')->first());
        }elseif(isset($hostWithoutSubdomain)){
            return new ProjectResource(Project::where('url', 'LIKE', '%' . $hostWithoutSubdomain . '%')->firstOrFail());
        }
        return new ProjectResource([]);
    });
    Route::get('{id}', function ($id) {
        $posts = 0;
        foreach (Auth::user()->roles->sortBy([['name', 'desc']]) as $role) {
            $posts += Project::find($id)->posts()->where('role_id', $role->id)->get()->count();
        }
        return response()->json([
            'project'=>$id,
            'count'=> strval($posts),
        ]);
    });
});
