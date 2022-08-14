<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Middleware\UsersAutenticator;
use App\Http\Controllers\UsersController;

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

Route::get('/login', [UsersController::class, "index"])->name('login');
Route::post('/login', [UsersController::class, "validateLogin"])->name('login.validate');
Route::post('/users/store', [UsersController::class, "store"])->name('users.store');

Route::middleware(UsersAutenticator::class)->group(function(){
    Route::get('/', function () {
        return redirect()->route('series.index'); 
    });
    
    Route::get('/logout', [UsersController::class, "logout"])->name('logout');
    Route::get('/index', [SeriesController::class, "index"])->name('series.index');
    
    Route::get('/series/create', [SeriesController::class, "create"])->name('series.create');
    Route::post('/series/store', [SeriesController::class, "store"])->name('series.store');
    Route::get('/series/show/{id}', [SeriesController::class, "show"])->name('series.show');
    Route::get('/series/edit/{id}', [SeriesController::class, "edit"])->name('series.edit');
    Route::post('/series/update', [SeriesController::class, "update"])->name('series.update');
    Route::post('/series/delete/{id}', [SeriesController::class, "destroy"])->name('series.destroy');
    Route::get('/series/json', [SeriesController::class, "showJson"])->name('series.json');
    Route::post('/series/json', [SeriesController::class, "decodeJson"])->name('series.json-decode');
    
    Route::get('/seasons/create/{id}', [SeasonsController::class, "create"])->name('seasons.create');
    Route::post('/seasons/store', [SeasonsController::class, "store"])->name('seasons.store');
    Route::get('/seasons/edit/{id}', [SeasonsController::class, "edit"])->name('seasons.edit');
    Route::post('/seasons/update', [SeasonsController::class, "update"])->name('seasons.update');
    Route::post('/seasons/delete/{id}/{serie_id}', [SeasonsController::class, "destroy"])->name('seasons.destroy');
    
    // Route::resource('seasons', SeasonsController::class)->except([
    //     'index','show','create','destroy'
    // ]);
    
    Route::get('/episodes/create/{id}', [EpisodesController::class, "create"])->name('episodes.create');
    Route::post('/episodes/store', [EpisodesController::class, "store"])->name('episodes.store');
    Route::get('/episodes/edit/{id}', [EpisodesController::class, "edit"])->name('episodes.edit');
    Route::post('/episodes/update', [EpisodesController::class, "update"])->name('episodes.update');
    Route::post('/episodes/delete/{id}/{serie_id}', [EpisodesController::class, "destroy"])->name('episodes.destroy');
});



