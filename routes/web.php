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
$router->group(['prefix' => 'api'], function () use ($router) {
    // Postingan
    $router->get('postingan_all', 'PostinganController@getPostinganAll');
    $router->get('postingan_by_id/{id}', 'PostinganController@getPostinganByid');
    $router->get('postingan_galery/{id}', 'PostinganController@getGaleryByIdTravel');
    $router->get('galery_travel/{id}', 'PostinganController@getGaleryTravelProfiel');
    $router->get('postingan_by_travel/{id}', 'PostinganController@getPostinganByidTravel');
    $router->post('postingan_create', 'PostinganController@postPostingan');
    $router->post('cari_postingan', 'PostinganController@cariPostingan');
    $router->put('postingan_update', 'PostinganController@updatePostingan');
    $router->delete('postingan_delete/{id}', 'PostinganController@deletePostingan');

    // Pesanan
    $router->get('pesanan_by_id_pesanan/{id}', 'PesananController@getPesananById');
    $router->get('pesanan_by_id_travel/{id}', 'PesananController@getPesananByIdTravel');
    $router->get('pesanan_by_id_user/{id}', 'PesananController@getPesananByIdUser');
    $router->post('pesanan_create', 'PesananController@postPesanan');
    $router->put('pesanan_update', 'PesananController@updatePesanan');
    
    //User
    $router->post('user_login', 'UserController@login');
    $router->post('user_register', 'UserController@register');
    $router->get('user_get_by_id/{id}', 'UserController@getUserById');
    $router->get('user_get_by_username/{username}', 'UserController@getUserByUsername');
    $router->post('user_update', 'UserController@updateUser');
});


