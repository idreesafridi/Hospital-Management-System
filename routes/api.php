<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api-search',[ApiController::class, 'apiSearch'])->name('api_search');
Route::get('/search/results', [ApiController::class, 'searchApi'])->name('search.results');
Route::get('/api-user-search/{id}',[ApiController::class, 'Userdetail'])->name('api_user_search');

Route::get('/search/youtube', [ApiController::class, 'searchYoutubeApi'])->name('search.youtube');
Route::get('/search/stream', [ApiController::class, 'searchStreamApi'])->name('search.stream');
