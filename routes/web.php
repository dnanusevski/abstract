<?php

use App\Http\Controllers\TestMailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
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
    return view('welcome');
});

Route::get('/spatie-test', function () {
    return view('welcome');
});

/*
Route::middleware(['auth','verified'])->get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/project', function () {
        return view('project.create');
    })->name('project');

    Route::post('/project-create', [ProjectController::class, 'store'])->name('create-project');
    Route::get('/send-email', [ProjectController::class, 'sendeMail'])->name('send-email');
    Route::get('/test-send-mail', [TestMailController::class, 'index']);
    Route::get('/test-spatie', [TestMailController::class, 'testSpatie']);
});
