<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\ItemController;
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



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/webhook', [WebhookController::class, 'handleWebhook']);

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

Route::post('/items/{id}/buy', [ItemController::class, 'buy'])->name('items.buy');

