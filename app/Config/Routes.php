<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;
use App\Controllers\AFCProcessingController;

/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [UserController::class, 'exit']);
$routes->get('/exit/', [UserController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->match(['get','post'],'/admin/', [UserController::class, 'auth']);
$routes->match(['get','post'],'/', [AFCProcessingController::class, 'test']);
