<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'CollabedManager',
    ['path' => '/collabed-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);
Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'CollabedManager', ['path' => '/collabed-manager'], function (RouteBuilder $routes) {
            $routes->fallbacks(DashedRoute::class);
        }
    );
});