<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Spatie\ServerMonitor\Models\Host;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/informer';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::model('project', Project::class);
        Route::bind('project', function ($value){
            return Project::withTrashed()->where('id', $value)->firstOrFail();
        });

        Route::model('post', Post::class);
        Route::bind('post', function ($value){
            return Post::withTrashed()->where('id', $value)->firstOrFail();
        });

        Route::model('comment', Comment::class);
        Route::bind('comment', function ($value){
            return Comment::where('id', $value)->firstOrFail();
        });

        Route::model('project_monitoring', Host::class);
        Route::bind('project_monitoring', function ($value){
            return Host::where('id', $value)->firstOrFail();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
