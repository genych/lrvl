<?php

use App\Http\Controllers\FeedController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', fn() => view('login'))->name('login');
Route::get('/', fn(FeedController $fc, Request $r) => $fc->view($r))->middleware(Authenticate::class)->name('home');
