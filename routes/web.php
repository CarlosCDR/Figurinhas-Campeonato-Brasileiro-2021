<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosicaoController;
use App\Http\Controllers\ClubesController;
use App\Http\Controllers\JogadoresController;
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
	"posicao" => PosicaoController::Class,
	"clube" => ClubesController::Class,
	"jogador" => JogadoresController::Class
]);
Route::get('/', function () {
    return view('futebol-figurinha-2021.index.index');
});
