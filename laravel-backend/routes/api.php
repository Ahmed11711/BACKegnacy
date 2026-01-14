<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CmsContentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SiteSettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/











Route::prefix('web')->group(function () {
    Route::get('/categories', [CategoryController::class, 'web']);
    Route::get('/services', [ServiceController::class, 'web']);
});

// Public routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Public product routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Public category routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// Public service routes
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

// Public bundle routes
Route::get('/bundles', [BundleController::class, 'index']);
Route::get('/bundles/{bundle}', [BundleController::class, 'show']);

// Public site settings
Route::get('/settings', [SiteSettingController::class, 'index']);
Route::get('/settings/{key}', [SiteSettingController::class, 'show']);

// Public CMS content routes
Route::prefix('cms')->group(function () {
    Route::get('/content', [CmsContentController::class, 'index']); // Get all content
    Route::get('/hero', [CmsContentController::class, 'getHero']);
    Route::get('/services', [CmsContentController::class, 'getServicesPage']);
    Route::get('/mission', [CmsContentController::class, 'getMission']);
    Route::get('/testimonials', [CmsContentController::class, 'getTestimonials']);
    Route::get('/about', [CmsContentController::class, 'getAbout']);
    Route::get('/portfolio', [CmsContentController::class, 'getPortfolio']);
    Route::get('/why-us', [CmsContentController::class, 'getWhyUs']);
    Route::get('/footer', [CmsContentController::class, 'getFooter']);
    Route::get('/seo', [CmsContentController::class, 'getSeo']);
});

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/email/verify', [AuthController::class, 'verifyEmail']);
        Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail']);
    });

    // Order routes (authenticated users)
    Route::apiResource('orders', OrderController::class);

    // Payment routes
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::get('/{payment}', [PaymentController::class, 'show']);
    });

    // Admin routes (require admin role)
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);

        // User management
        Route::get('/users', [AdminController::class, 'users']);
        Route::put('/users/{user}', [AdminController::class, 'updateUser']);

        // Product management
        Route::apiResource('products', ProductController::class)->except(['index', 'show']);

        // Category management
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);

        // Service management
        Route::apiResource('services', ServiceController::class)->except(['index', 'show']);

        // Bundle management
        Route::apiResource('bundles', BundleController::class)->except(['index', 'show']);

        // Site settings
        Route::put('/settings', [SiteSettingController::class, 'update']);

        // Activity logs
        Route::get('/activity-logs', [AdminController::class, 'activityLogs']);
    });
});
