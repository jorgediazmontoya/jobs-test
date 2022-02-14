<?php

use App\Events\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Multitenancy\Models\Tenant;
use App\Http\Controllers\FileController;
use App\Jobs\UserJob;

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

Route::get('/tenants', function (Request $request) {
    dd(Tenant::current());
    return User::all();
});

Route::post('/users', function (Request $request) {
    $user = new User($request->all());
    //event(new CreateUser ($user));
    UserJob::dispatch($user);
    return $user;
});

Route::get('/files', [FileController::class, 'upload']);
