<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'LocationManager',
    ['path' => '/location-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::prefix('admin', function ($routes) {
    $routes->connect('/locations/:action/*', ['controller' => 'Locations', 'plugin' => 'LocationManager']);
    $routes->plugin(
        'LocationManager', ['path' => '/location-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});
