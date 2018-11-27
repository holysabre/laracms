<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@articles');
    $router->resource('categories', CategoryController::class);
    $router->resource('modules', ModuleController::class);
    $router->resource('pages', PageController::class);
    $router->resource('articles111', ArticleController::class);

});