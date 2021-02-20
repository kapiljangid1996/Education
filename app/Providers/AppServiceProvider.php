<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

Use View;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Rating;
use App\Models\College\College;
use App\Models\Course\Course;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Site Settings
        $settings = Setting::first();
        View::share('settings', $settings);

        //Categories on Courses List Page
        View::composer('front.courseView', function($view)
        {
            $categories = Category::with('children')->whereNull('parent_id')->get();
            $view->with('categories', $categories);
        });

        //Ratings on College Detail Page
        View::composer('front.collegeDetail', function($view)
        {
            $categories = Category::with('children')->whereNull('parent_id')->get();
            $view->with('categories', $categories);
        });

        //Course on Footer Page
        View::composer('pages.footer', function($view)
        {
            $courses = Course::where('status','=', 1)->get();
            $view->with('courses', $courses);
        });

        //College on Footer Page
        View::composer('pages.footer', function($view)
        {
            $colleges = College::where('status','=', 1)->where('featured_colleges','=', 1)->get();
            $view->with('colleges', $colleges);
        });
    }
}
