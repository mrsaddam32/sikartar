<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FundController;

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

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['isLogged'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::patch('/profile/{id}', [DashboardController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password/{id}', [DashboardController::class, 'updatePassword'])->name('profile.updatePassword');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [UserController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('event')->name('event.')->group(function () {
            Route::get('/', [ActivityController::class, 'index'])->name('index');
            Route::get('/create', [ActivityController::class, 'create'])->name('create');
            Route::post('/store', [ActivityController::class, 'store'])->name('store');
            Route::get('/detail', [ActivityController::class, 'show'])->name('show');
            Route::post('/upload-files/{activity_id}', [ActivityController::class, 'uploadFiles'])->name('uploadFiles');
            Route::get('/edit', [ActivityController::class, 'edit'])->name('edit');
            Route::put('/update/{activities_id}', [ActivityController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [ActivityController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('keuangan')->name('keuangan.')->group(function () {
            Route::get('/', [FundController::class, 'index'])->name('index');
            Route::get('/create', [FundController::class, 'create'])->name('create');
            Route::post('/store', [FundController::class, 'store'])->name('store');
            Route::get('/edit', [FundController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [FundController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FundController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('user')->middleware('role:user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::patch('/profile/{id}', [DashboardController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password/{id}', [DashboardController::class, 'updatePassword'])->name('profile.updatePassword');

        Route::prefix('event')->name('event.')->group(function () {
            Route::get('/', [ActivityController::class, 'index'])->name('index');
            Route::get('/create', [ActivityController::class, 'create'])->name('create');
            Route::post('/store', [ActivityController::class, 'store'])->name('store');
            Route::get('/detail', [ActivityController::class, 'show'])->name('show');
            Route::post('/upload-files/{activity_id}', [ActivityController::class, 'uploadFiles'])->name('uploadFiles');
            Route::get('/edit', [ActivityController::class, 'edit'])->name('edit');
            Route::put('/update/{activities_id}', [ActivityController::class, 'update'])->name('update');
        });
    });
});
