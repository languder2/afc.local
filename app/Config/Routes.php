<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;
use App\Controllers\AFCController;

/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [UserController::class, 'exit']);
$routes->get('/exit/', [UserController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->match(['get','post'],'/admin/', [UserController::class, 'auth']);
$routes->match(['get','post'],'/', [AFCController::class, 'summary']);
$routes->match(['get','post'],'/afc/spec/(:num)', [AFCController::class, 'chartSpecByDays/$1']);
$routes->match(['get','post'],'/afc/(:segment)/(:num)', [AFCController::class, 'chartByDays/$1/$2']);
$routes->match(['get','post'],'/test', [AFCController::class, 'test']);
