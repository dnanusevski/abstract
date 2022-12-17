<?php

use App\Http\Controllers\Api\SendMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
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



/*
Route::post('/send-mail', function (Request $request) {
    return $request->all();
});
*/
Route::post('/send-mail', [SendMailController::class, 'send']);

Route::post('/test-fail', function (Request $request) {
    Log::debug('Access success another time');
});
