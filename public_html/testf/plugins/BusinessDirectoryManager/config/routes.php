<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'BusinessDirectoryManager',
    ['path' => '/business-directory-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

 
Router::prefix('admin', function ($routes) {
    $routes->connect('/business-directory-manager',['controller'=>'jobs','action'=>'index' , 'plugin'=>'BusinessDirectoryManager']);
    $routes->plugin(
            'BusinessDirectoryManager', ['path' => '/business-directory-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});
