<?php

namespace App\Providers;

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
        //注册观察者
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\Page::observe(\App\Observers\PageObserver::class);
        \App\Models\Article::observe(\App\Observers\ArticleObserver::class);
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
