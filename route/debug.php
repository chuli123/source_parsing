<?php
require "./Route.php";
require "./RouteRegistrar.php";
require "./Router.php";
try {
    //第一次调用__callStatic 所以value为null
    Router::where('name', '[a-z]+')
        //这次直接调用where方法 所以第一个参数是where方法的第一个参数，第二个参数是where方法的第二个参数
        ->where('id', '\d{1,2}')
        ->prefix("admin")
        ->namespace("Admin\\Controller")
        ->group(function (Router $router) {
            Router::get('dashboard', 'DashboardController@index');
            Router::prefix("order")
                ->group(function () {
                    Router::post('add', 'OrderController@add');
                    Router::post('index', 'OrderController/index');
                });
        });

    /**
     * @var  $item Route
     * **/
    foreach (Router::getInstance()->getRouteCollection() as $item) {
        echo $item->getRule() . '->' . $item->getAction() . "\n";
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}

