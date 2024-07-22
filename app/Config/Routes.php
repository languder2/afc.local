<?php

use App\Controllers\Test;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\AFCSpec;
use App\Controllers\AFCSummary;


/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [UserController::class, 'exit']);
$routes->get('/exit/', [UserController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->get(   "old",                                  [Test::class, 'summary']);
$routes->get(   "afc/spec/(:num)",                      [Test::class, 'chartSpecByDays']);
$routes->get(   'byDays/(:any)',                        [Test::class, 'byDays']);



$routes->get('/',                                       [AFCSummary::class,     "list"]);
$routes->get('specs/',                                  [AFCSpec::class,        "list"]);
$routes->get('spec/(:segment)',                         [[AFCSpec::class,       "detail"],"code/$1"]);
$routes->get('profile/(:num)',                          [[AFCSpec::class,       "detail"],"id/$1"]);
$routes->get('details/apps',                            [[AFCSummary::class,    "detail"],"apps"]);
