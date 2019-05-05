<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'EventManager',
    ['path' => '/event-manager'],
    function (RouteBuilder $routes) {
  
        $routes->fallbacks(DashedRoute::class);
    }
);


Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'EventManager', ['path' => '/event-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});