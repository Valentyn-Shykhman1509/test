<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/'], function ($router) {
    $router->post('user/register/','AuthController@signUp');
	$router->post('user/sign-in/','AuthController@signIn');
	$router->post('user/send-token', 'AuthController@sendToken');
	$router->post('user/recover-password', 'AuthController@updatePassword');
	$router->post('user/companies', 'CompanyController@addCompany');
	$router->get('user/companies', 'CompanyController@getCompanies');
    
});
