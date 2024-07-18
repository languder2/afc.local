<?php

use App\Controllers\AFCSpec;
use App\Controllers\Test;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [UserController::class, 'exit']);
$routes->get('/exit/', [UserController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->match(['get', 'post'], '/admin/', [UserController::class, 'auth']);
$routes->match(['get', 'post'], '/', [Test::class, 'summary']);
$routes->match(['get', 'post'], '/afc/spec/(:num)', [Test::class, 'chartSpecByDays/$1']);
$routes->match(['get', 'post'], '/byDays/(:any)', [Test::class, 'byDays/$1']);

$routes->get('/specs/', [Test::class, 'specList']);


$routes->get('/spec/',                                  [AFCSpec::class, "list"]);
