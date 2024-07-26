<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\AFC;
use App\Controllers\Auth;

/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */

$routes->get('/',                                       [AFC::class,    "summary"]);
$routes->get('specs/',                                  [AFC::class,    "list"]);
$routes->get('spec/(:segment)',                         [[AFC::class,   "detail"],"code/$1"]);
$routes->get('profile/(:num)',                          [[AFC::class,   "detail"],"id/$1"]);
$routes->get('details/(:segment)',                      [AFC::class,    "detailsSummary"]);
$routes->get("/map",                                    [AFC::class,    'map']);

$routes->post("auth",                                   [Auth::class,   'auth']);
$routes->get("exit",                                    [Auth::class,   'exit']);
