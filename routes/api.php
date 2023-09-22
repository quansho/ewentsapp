<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\User\Index as UsersIndex;
use App\Http\Controllers\Api\v1\User\Store as UsersStore;
use App\Http\Controllers\Api\v1\User\Delete as UserDelete;

use \App\Http\Controllers\Api\v1\Event\Index as EventIndex;
use \App\Http\Controllers\Api\v1\Event\Store as EventStore;
use \App\Http\Controllers\Api\v1\Event\Show as EventShow;
use \App\Http\Controllers\Api\v1\Event\Update as EventUpdate;
use \App\Http\Controllers\Api\v1\Event\Delete as EventDelete;
use \App\Http\Controllers\Api\v1\Event\Subscribe as EventSubscribe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndex::class);
        Route::post('/', UsersStore::class);
        Route::delete('/{user}', UserDelete::class);
    });

    Route::prefix('events')->group(function () {
        Route::get('/', EventIndex::class);
        Route::post('/', EventStore::class);
        Route::get('/{event}', EventShow::class);
        Route::put('/{event}', EventUpdate::class);
        Route::delete('/{event}', EventDelete::class);
        Route::post('/{event}/subscribe', EventSubscribe::class);
    });
});

Route::post('login', [Login::class, '__invoke']);
Route::post('logout', [Logout::class, '__invoke']);
Route::post('register', [Register::class, '__invoke']);
