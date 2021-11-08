<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosicaoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resources([
	"posicao" => PosicaoController::Class
]);
Route::get('/', function () {
    return view('futebol-figurinha-2021.index.index');
});
