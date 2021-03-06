<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clear', function() {
    //ruta para forzar el limpiado de cache sin usar la consola
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "Comandos Ejecutados Correctamente --";
});


$router->group(['prefix' => 'v1/admin','middleware' => ['auth']], function() use ($router) {
    // rutas de recursos de acceso
    require (__DIR__ . '/admin/usuario.php');

}
);

$router->group(['prefix' => 'v1/admin','middleware' => ['authClient']], function() use ($router) {
    // rutas de recursos de acceso
    require (__DIR__ . '/admin/cliente.php');
}
);


 $router->group(['prefix' => 'v1/admin'], function() use ($router) {
    // rutas de recursos de acceso
    require (__DIR__ . '/admin/auth.php');
}
);