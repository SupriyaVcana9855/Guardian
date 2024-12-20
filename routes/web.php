<?php

use App\Http\Controllers\ApiController\HomeController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\NewsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BackgroundController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\HeaderController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\UsefullLinkController;
use App\Http\Controllers\Backend\PageDesignController;
use App\Http\Controllers\Backend\FooterController;
use App\Http\Controllers\Backend\PageContentController;
use App\Http\Controllers\Backend\BannerController;



use Illuminate\Support\Facades\Artisan;

Route::get('/welcome', function () {
    return view('welcome');
});


// Guest Middleware Group
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Auth Middleware Group
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');

    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('/saveChangePassword', [AuthController::class, 'saveChangePassword'])->name('saveChangePassword');
        // Resource Routes
    Route::resource('header', HeaderController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('home', BackendHomeController::class);
    Route::resource('about', AboutController::class);
    Route::resource('news', NewsController::class);
    Route::resource('link', UsefullLinkController::class);
    Route::resource('page', PageDesignController::class);
    Route::resource('footer', FooterController::class);
    Route::resource('content', PageContentController::class);

    Route::resource('banner', BannerController::class);

    Route::post('/saveDesign', [PageDesignController::class, 'saveDesign'])->name('saveDesign');

    Route::get('/background/{param}', [BackgroundController::class, 'background'])->name('background');
    Route::post('/savebackground', [BackgroundController::class, 'savebackground'])->name('savebackground');
   

    
    Route::post('/website-style', [PageDesignController::class, 'homeBackground'])->name('website-style');
});


// Database Migration Route
Route::get('/header-seeder', function () {
    try {
        Artisan::call('db:seed');
        return response()->json([
            'status' => 'success',
            'message' => 'Database seed executed successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to run seed: ' . $e->getMessage(),
        ], 500);
    }
});

// Database Migration Route
Route::get('/migrate', function () {
    try {
        Artisan::call('migrate:fresh');
        return response()->json([
            'status' => 'success',
            'message' => 'Database migrations executed successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to run migrations: ' . $e->getMessage(),
        ], 500);
    }
});

// Clear Cache Route
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return response()->json([
        'status' => 'success',
        'message' => 'Application cache cleared successfully.',
    ]);
})->name('clear.cache');


