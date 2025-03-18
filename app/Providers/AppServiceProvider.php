<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\NewsReviewPages;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categorysall = Category::get();
        $newsReviews = NewsReviewPages::get();
        $global = GlobalSetting::first();
        // dd($global);
        // Correctly share the variables
        view()->share([
            'categorysall' => $categorysall,
            'newsReviews' => $newsReviews,
            'global' => $global,
            
        ]);
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $admin = Auth::user();
                $view->with('user', $admin);
            }
        });
        View::composer('components.app', function ($view) {
            $view->with('data', 'Global Dynamic Data');
        });

    }
}
