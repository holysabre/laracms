<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Config\Config;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(\App\Observers\CategoryObserver::class);
        Config::load();
        $this->app->singleton(FakerGenerator::class ,function(){
            return FakerFactory::create('zh_CN');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
