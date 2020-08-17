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

$router->group(["prefix" => "api/empresas","middleware" => "secret"], function () use ($router) {
	$router->get("", "EmpresaController@index");
	$router->get("/{id}", "EmpresaController@show");
	$router->post("", "EmpresaController@store");
});
$router->group(["prefix" => "api/horarios"], function () use ($router) {
	$router->get("", "HorarioAtencionController@index");
	$router->post("", "HorarioAtencionController@store");
	$router->get("/empresas", "HorarioAtencionController@showEmpresasAbiertas");
	$router->put("/{id}", "HorarioAtencionController@update");
	$router->get("/empresa/{idEmpresa}", "HorarioAtencionController@showByIdDiaSemanaAndIdEmpresa");
});
$router->group(["prefix" => "api/feriados"], function () use ($router) {
	$router->get("", "FeriadoController@index");
	$router->post("", "FeriadoController@store");
	$router->put("/{id}", "FeriadoController@update");
	$router->delete("/{id}", "FeriadoController@destroy");
});
