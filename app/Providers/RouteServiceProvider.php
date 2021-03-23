<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot(): void
    {
        Route::pattern('page', '[0-9]+');

        parent::boot();

        Route::bind('post', function ($value) {
            return Post::where('slug', $value)
                ->orWhere('id', $value)
                ->firstOrFail();
        });
        Route::bind('category', function ($value) {
            return Category::where('slug', $value)
                ->orWhere('id', $value)
                ->firstOrFail();
        });
        Route::bind('user', function ($value) {
            return User::where('id', $value)
                ->orWhere('slug', $value)
                ->firstOrFail();
        });
    }

    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapFrontendRoutes();
        $this->mapLoggedRoutes();
        $this->mapAdminRoutes();
    }

    protected function mapFrontendRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web/frontend.php'));
    }

    public function mapLoggedRoutes(): void
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web/logged.php'));
    }

    public function mapAdminRoutes(): void
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Admin')
            ->prefix('admin-panel')
            ->as('admin.')
            ->group(base_path('routes/web/admin.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
