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
        
        // CMS Management
        Route::prefix('cms')->name('cms.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminCmsController::class, 'index'])->name('index');
            
            // Page Content
            Route::get('/page-content', [App\Http\Controllers\Admin\AdminCmsController::class, 'pageContent'])->name('page-content');
            Route::post('/page-content', [App\Http\Controllers\Admin\AdminCmsController::class, 'storePageContent'])->name('page-content.store');
            
            // Testimonials
            Route::get('/testimonials', [App\Http\Controllers\Admin\AdminCmsController::class, 'testimonials'])->name('testimonials');
            Route::get('/testimonials/create', [App\Http\Controllers\Admin\AdminCmsController::class, 'testimonialForm'])->name('testimonials.create');
            Route::get('/testimonials/{testimonial}/edit', [App\Http\Controllers\Admin\AdminCmsController::class, 'testimonialForm'])->name('testimonials.edit');
            Route::post('/testimonials', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeTestimonial'])->name('testimonials.store');
            Route::put('/testimonials/{testimonial}', [App\Http\Controllers\Admin\AdminCmsController::class, 'updateTestimonial'])->name('testimonials.update');
            Route::delete('/testimonials/{testimonial}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteTestimonial'])->name('testimonials.destroy');
            
            // Portfolio
            Route::get('/portfolio', [App\Http\Controllers\Admin\AdminCmsController::class, 'portfolioProjects'])->name('portfolio');
            Route::get('/portfolio/create', [App\Http\Controllers\Admin\AdminCmsController::class, 'portfolioProjectForm'])->name('portfolio.create');
            Route::get('/portfolio/{project}/edit', [App\Http\Controllers\Admin\AdminCmsController::class, 'portfolioProjectForm'])->name('portfolio.edit');
            Route::post('/portfolio', [App\Http\Controllers\Admin\AdminCmsController::class, 'storePortfolioProject'])->name('portfolio.store');
            Route::put('/portfolio/{project}', [App\Http\Controllers\Admin\AdminCmsController::class, 'updatePortfolioProject'])->name('portfolio.update');
            Route::delete('/portfolio/{project}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deletePortfolioProject'])->name('portfolio.destroy');
            
            // Mission Pillars
            Route::get('/mission-pillars', [App\Http\Controllers\Admin\AdminCmsController::class, 'missionPillars'])->name('mission-pillars');
            Route::post('/mission-pillars', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeMissionPillar'])->name('mission-pillars.store');
            Route::put('/mission-pillars/{pillar}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeMissionPillar'])->name('mission-pillars.update');
            Route::delete('/mission-pillars/{pillar}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteMissionPillar'])->name('mission-pillars.destroy');
            
            // Hero Sections
            Route::get('/hero/quick-links', [App\Http\Controllers\Admin\AdminCmsController::class, 'heroQuickLinks'])->name('hero-quick-links');
            Route::post('/hero/quick-links', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeHeroQuickLink'])->name('hero-quick-links.store');
            Route::put('/hero/quick-links/{link}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeHeroQuickLink'])->name('hero-quick-links.update');
            Route::delete('/hero/quick-links/{link}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteHeroQuickLink'])->name('hero-quick-links.destroy');
            
            Route::get('/hero/advantages', [App\Http\Controllers\Admin\AdminCmsController::class, 'heroAdvantages'])->name('hero-advantages');
            Route::post('/hero/advantages', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeHeroAdvantage'])->name('hero-advantages.store');
            Route::put('/hero/advantages/{advantage}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeHeroAdvantage'])->name('hero-advantages.update');
            Route::delete('/hero/advantages/{advantage}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteHeroAdvantage'])->name('hero-advantages.destroy');
            
            // About Sections
            Route::get('/about/stats', [App\Http\Controllers\Admin\AdminCmsController::class, 'aboutStats'])->name('about-stats');
            Route::post('/about/stats', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeAboutStat'])->name('about-stats.store');
            Route::put('/about/stats/{stat}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeAboutStat'])->name('about-stats.update');
            Route::delete('/about/stats/{stat}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteAboutStat'])->name('about-stats.destroy');
            
            Route::get('/about/core-values', [App\Http\Controllers\Admin\AdminCmsController::class, 'aboutCoreValues'])->name('about-core-values');
            Route::post('/about/core-values', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeAboutCoreValue'])->name('about-core-values.store');
            Route::put('/about/core-values/{value}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeAboutCoreValue'])->name('about-core-values.update');
            Route::delete('/about/core-values/{value}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteAboutCoreValue'])->name('about-core-values.destroy');
            
            // Why Us
            Route::get('/why-us', [App\Http\Controllers\Admin\AdminCmsController::class, 'whyUsFeatures'])->name('why-us-features');
            Route::post('/why-us', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeWhyUsFeature'])->name('why-us-features.store');
            Route::put('/why-us/{feature}', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeWhyUsFeature'])->name('why-us-features.update');
            Route::delete('/why-us/{feature}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deleteWhyUsFeature'])->name('why-us-features.destroy');
            
            // SEO
            Route::get('/seo', [App\Http\Controllers\Admin\AdminCmsController::class, 'seoSettings'])->name('seo-settings');
            Route::post('/seo', [App\Http\Controllers\Admin\AdminCmsController::class, 'storeSeoSetting'])->name('seo-settings.store');
            
            // Images
            Route::get('/images', [App\Http\Controllers\Admin\AdminCmsController::class, 'pageImages'])->name('images');
            Route::post('/images', [App\Http\Controllers\Admin\AdminCmsController::class, 'storePageImage'])->name('images.store');
            Route::delete('/images/{image}', [App\Http\Controllers\Admin\AdminCmsController::class, 'deletePageImage'])->name('images.destroy');
        });
    });
});

// Home route (public website)
Route::get('/home', function () {
    return view('home');
})->name('home');
