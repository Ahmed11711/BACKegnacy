<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Main Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    // Orders (both admin and users)
    Route::prefix('orders')->name('web.orders.')->group(function () {
        Route::get('/', [App\Http\Controllers\Web\OrderController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Web\OrderController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Web\OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [App\Http\Controllers\Web\OrderController::class, 'show'])->name('show');
    });
    
    // Payments
    Route::prefix('payments')->name('web.payments.')->group(function () {
        Route::get('/', [App\Http\Controllers\Web\PaymentController::class, 'index'])->name('index');
        Route::get('/{payment}', [App\Http\Controllers\Web\PaymentController::class, 'show'])->name('show');
    });
    
    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('update');
            Route::delete('/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('destroy');
        });
        
        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminProductController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\AdminProductController::class, 'store'])->name('store');
            Route::get('/{product}', [App\Http\Controllers\Admin\AdminProductController::class, 'show'])->name('show');
            Route::get('/{product}/edit', [App\Http\Controllers\Admin\AdminProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [App\Http\Controllers\Admin\AdminProductController::class, 'destroy'])->name('destroy');
        });
        
        // Categories
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminCategoryController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminCategoryController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\AdminCategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [App\Http\Controllers\Admin\AdminCategoryController::class, 'show'])->name('show');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\AdminCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [App\Http\Controllers\Admin\AdminCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [App\Http\Controllers\Admin\AdminCategoryController::class, 'destroy'])->name('destroy');
        });
        
        // Services
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminServiceController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminServiceController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\AdminServiceController::class, 'store'])->name('store');
            Route::get('/{service}', [App\Http\Controllers\Admin\AdminServiceController::class, 'show'])->name('show');
            Route::get('/{service}/edit', [App\Http\Controllers\Admin\AdminServiceController::class, 'edit'])->name('edit');
            Route::put('/{service}', [App\Http\Controllers\Admin\AdminServiceController::class, 'update'])->name('update');
            Route::delete('/{service}', [App\Http\Controllers\Admin\AdminServiceController::class, 'destroy'])->name('destroy');
        });
        
        // Bundles
        Route::prefix('bundles')->name('bundles.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminBundleController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminBundleController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\AdminBundleController::class, 'store'])->name('store');
            Route::get('/{bundle}', [App\Http\Controllers\Admin\AdminBundleController::class, 'show'])->name('show');
            Route::get('/{bundle}/edit', [App\Http\Controllers\Admin\AdminBundleController::class, 'edit'])->name('edit');
            Route::put('/{bundle}', [App\Http\Controllers\Admin\AdminBundleController::class, 'update'])->name('update');
            Route::delete('/{bundle}', [App\Http\Controllers\Admin\AdminBundleController::class, 'destroy'])->name('destroy');
        });
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminSettingController::class, 'index'])->name('index');
            Route::put('/', [App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('update');
        });
        
        // Activity Logs
        Route::prefix('activity-logs')->name('activity-logs.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminActivityLogController::class, 'index'])->name('index');
            Route::get('/{log}', [App\Http\Controllers\Admin\AdminActivityLogController::class, 'show'])->name('show');
        });
    });
});

// Home route (public website)
Route::get('/home', function () {
    return view('home');
})->name('home');
