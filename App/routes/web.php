<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/sell', function () {
    return view('sell');
})->name('sell');

Route::get('/buy', [\App\Http\Controllers\ItemsController::class, 'getSellItems'])->name('buy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/sell', [\App\Http\Controllers\ItemsController::class, 'getBuyItems']) -> name('sell');

Route::get('/sell/new', function () {
    return view('newbuyorder');
})->middleware('auth');

Route::post('/sell/new', [\App\Http\Controllers\ItemsController::class, 'storeBuy'])->middleware('auth');

Route::get('/sell/view/{id}', [\App\Http\Controllers\ItemsController::class, 'openRequestSell']);

Route::post('filters', [\App\Http\Controllers\ItemsController::class, 'setFilters']);

Route::get('/buy/new', function () {
    return view('newsellorder');
})->middleware('auth');

Route::post('/buy/new', [\App\Http\Controllers\ItemsController::class, 'storeSell'])->middleware('auth');

Route::get('/buy/view/{id}', [\App\Http\Controllers\ItemsController::class, 'openRequestBuy']);

Route::get('/sell/view/{id}/redact', [\App\Http\Controllers\ItemsController::class, 'openRedactSell'])->middleware('auth');
Route::post('/sell/view/{id}/redact', [\App\Http\Controllers\ItemsController::class, 'redactSell'])->middleware('auth');
Route::post('/sell/view/{id}/redact/delete', [\App\Http\Controllers\ItemsController::class, 'redactBuyDelete'])->middleware('auth');

Route::get('/buy/view/{id}/redact', [\App\Http\Controllers\ItemsController::class, 'openRedactBuy'])->middleware('auth');
Route::post('/buy/view/{id}/redact', [\App\Http\Controllers\ItemsController::class, 'redactBuy'])->middleware('auth');
Route::post('/buy/view/{id}/redact/delete', [\App\Http\Controllers\ItemsController::class, 'redactSellDelete'])->middleware('auth');

Route::get('/chats', [\App\Http\Controllers\MessageController::class, 'getChats'])->middleware('auth');

Route::get('/chats/{id}', [\App\Http\Controllers\MessageController::class, 'getChat'])->middleware('auth');

Route::post('/chats/{id}/approve', [\App\Http\Controllers\MessageController::class, 'approveRequest'])->middleware('auth');

Route::post('chats/{id}/send', [\App\Http\Controllers\MessageController::class, 'sendMessage']);

Route::post('/sell/view/{id}/request', [\App\Http\Controllers\MessageController::class, 'sendRequest'])->middleware('auth');
Route::post('/buy/view/{id}/request', [\App\Http\Controllers\MessageController::class, 'sendRequest'])->middleware('auth');

Route::get('download/{file}', function ($file) {
    return \Illuminate\Support\Facades\Response::download(public_path("uploads\\".$file));
});

require __DIR__.'/auth.php';
