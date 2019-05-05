<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'ArtistManager',
    ['path' => '/artist-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'ArtistManager', ['path' => '/artist-manager'], function (RouteBuilder $routes) {
            $routes->fallbacks(DashedRoute::class);
        }
    );
});