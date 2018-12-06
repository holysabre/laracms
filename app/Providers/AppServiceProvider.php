<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Config\Config;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use View;

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
        Category::observe(\App\Observers\CategoryObserver::class);
        Page::observe(\App\Observers\PageObserver::class);
        Config::load();
        $this->app->singleton(FakerGenerator::class ,function(){
            return FakerFactory::create('zh_CN');
        });
        /* 栏目视图共享 */
        $model_category = new Category();
        $category_list = $model_category->getTree();
        View::share('categories',$category_list);
        /* 栏目视图共享 */
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
