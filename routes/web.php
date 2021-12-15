<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', 'PostinganController@index');

// Presensi
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('postingan_all', 'PostinganController@getPostinganAll');
});


