<?php

use App\Http\Controllers\FeedController;
use App\Models\Story;
use Illuminate\Support\Facades\Route;

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

//todo: authentication
//Route::middleware('auth:sanctum')->group(fn() => [
//    Route::get('/feed', fn(FeedController $c) => $c->list()),
//    Route::delete('/delete/{story}', fn(FeedController $c, Story $story) => $c->del($story)),
//]);

Route::get('/feed', fn(FeedController $fc) => $fc->list());
Route::delete('/delete/{story}', fn(FeedController $c, Story $story) => $c->del($story));
//Route::post('/login', fn(UserController $uc, Request $r) => $uc->login($r));
