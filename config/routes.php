<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Route\Route;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {

        $builder->connect('/', ['controller' => 'users', 'action' => 'index']);
        // $builder->connect('/user-logedin/:id', ['controller' => 'userLogedin', 'action' => 'userLogedin'], ["pass" => ["id"]])->setPatterns(["id" => "[0-9]+"]);

        $builder->connect('/pages/*', 'Pages::display');

        $builder->fallbacks();
    });

    $routes->prefix('Admin', function (RouteBuilder $routes) {

        $routes->connect('/:data', array('controller' => 'first', 'action' => 'index'));
    });
};
