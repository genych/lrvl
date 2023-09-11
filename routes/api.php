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

Route::delete('/story/{story}', fn(FeedController $fc, Story $story) => $fc->del($story));
