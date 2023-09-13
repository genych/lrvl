<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
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

Route::post('/login', fn(UserController $uc, \Illuminate\Http\Request $r) => $uc->login($r));

Route::post('/logout', fn(UserController $uc) => $uc->logout())->middleware(Authenticate::class);
Route::delete('/story/{story}', fn(FeedController $fc, Story $story) => $fc->del($story))->middleware(Authenticate::class);
