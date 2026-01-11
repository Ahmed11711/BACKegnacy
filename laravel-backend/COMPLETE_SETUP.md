# Complete Laravel Backend Setup Guide

This is a comprehensive Laravel backend API with authentication, CRUD operations, admin panel, and additional features.

## Project Structure

```
laravel-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── AdminController.php
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php
│   │   │   ├── BundleController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── OrderController.php
│   │   │   ├── PaymentController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ServiceController.php
│   │   │   └── SiteSettingController.php
│   │   ├── Middleware/
│   │   │   └── EnsureUserIsAdmin.php
│   │   ├── Requests/
│   │   │   ├── Auth/
│   │   │   ├── Category/
│   │   │   ├── Order/
│   │   │   ├── Product/
│   │   │   └── SiteSetting/
│   │   └── Resources/
│   │       ├── ActivityLogResource.php
│   │       ├── BundleResource.php
│   │       ├── CategoryResource.php
│   │       ├── OrderItemResource.php
│   │       ├── OrderResource.php
│   │       ├── PaymentResource.php
│   │       ├── ProductResource.php
│   │       ├── ServiceResource.php
│   │       └── UserResource.php
│   ├── Models/
│   │   ├── ActivityLog.php
│   │   ├── Bundle.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Payment.php
│   │   ├── Product.php
│   │   ├── Service.php
│   │   ├── SiteSetting.php
│   │   └── User.php
│   ├── Services/
│   │   ├── FileUploadService.php
│   │   ├── OrderService.php
│   │   └── ProductService.php
│   └── Traits/
│       └── LogsActivity.php
├── database/
│   ├── migrations/
│   │   └── (12 migration files)
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── BundleSeeder.php
│   │   ├── CategorySeeder.php
│   │   ├── ProductSeeder.php
│   │   ├── ServiceSeeder.php
│   │   ├── SiteSettingSeeder.php
│   │   └── UserSeeder.php
│   └── factories/
│       ├── ProductFactory.php
│       └── UserFactory.php
└── routes/
    └── api.php
```

## Installation Steps

1. **Copy all files** to your Laravel project directory

2. **Install Laravel Sanctum**:
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

3. **Update `config/sanctum.php`**:
```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
))),
```

4. **Update `app/Http/Kernel.php`** (if using Laravel 10+):
```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

5. **Update User Model** to use HasApiTokens trait (already included in provided User.php)

6. **Run migrations**:
```bash
php artisan migrate
```

7. **Run seeders**:
```bash
php artisan db:seed
```

8. **Create storage link**:
```bash
php artisan storage:link
```

9. **Update `.env`**:
```env
APP_NAME="Media Agency Elite"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000
SESSION_DOMAIN=localhost
```

## Default Credentials

After seeding:
- **Admin Email**: admin@example.com
- **Admin Password**: password
- **User Password**: password (for all seeded users)

## API Endpoints

### Authentication
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - Login user
- `POST /api/auth/logout` - Logout user (requires auth)
- `GET /api/auth/user` - Get authenticated user (requires auth)

### Products (Public)
- `GET /api/products` - List all products (with filters)
- `GET /api/products/{id}` - Get product details

### Products (Admin)
- `POST /api/admin/products` - Create product
- `PUT /api/admin/products/{id}` - Update product
- `DELETE /api/admin/products/{id}` - Delete product

### Categories
- `GET /api/categories` - List categories
- `GET /api/categories/{id}` - Get category details
- `POST /api/admin/categories` - Create category (admin)
- `PUT /api/admin/categories/{id}` - Update category (admin)
- `DELETE /api/admin/categories/{id}` - Delete category (admin)

### Orders
- `GET /api/orders` - List orders (requires auth, filtered by user if not admin)
- `POST /api/orders` - Create order (requires auth)
- `GET /api/orders/{id}` - Get order details (requires auth)
- `PUT /api/orders/{id}` - Update order (requires auth)

### Services
- `GET /api/services` - List services
- `GET /api/services/{id}` - Get service details
- `POST /api/admin/services` - Create service (admin)
- `PUT /api/admin/services/{id}` - Update service (admin)
- `DELETE /api/admin/services/{id}` - Delete service (admin)

### Bundles
- `GET /api/bundles` - List bundles
- `GET /api/bundles/{id}` - Get bundle details
- `POST /api/admin/bundles` - Create bundle (admin)
- `PUT /api/admin/bundles/{id}` - Update bundle (admin)
- `DELETE /api/admin/bundles/{id}` - Delete bundle (admin)

### Site Settings
- `GET /api/settings` - Get all settings
- `GET /api/settings/{key}` - Get setting by key
- `PUT /api/admin/settings` - Update settings (admin)

### Admin Panel
- `GET /api/admin/dashboard` - Dashboard statistics (admin)
- `GET /api/admin/users` - List users (admin)
- `PUT /api/admin/users/{id}` - Update user (admin)
- `GET /api/admin/activity-logs` - Get activity logs (admin)

## Features Implemented

✅ Authentication with Laravel Sanctum
✅ Role-based access control (Admin/User)
✅ CRUD operations for all entities
✅ Request validation
✅ API Resources for consistent responses
✅ Service classes for business logic
✅ File uploads with FileUploadService
✅ Activity logging with ActivityLog model
✅ Soft deletes on main entities
✅ Database relationships (One-to-One, One-to-Many, Many-to-Many)
✅ Search, filtering, and pagination
✅ Site settings management
✅ Admin panel endpoints
✅ Seeders for testing data
✅ Factories for model generation

## Notes

- All admin routes require authentication AND admin role
- User routes are filtered to show only user's own data (unless admin)
- File uploads stored in `storage/app/public`
- Activity logs track all admin actions
- Soft deletes used for safe deletion
- All responses follow consistent JSON format

## Testing

You can test the API using Postman, Insomnia, or any HTTP client.

Example login request:
```json
POST /api/auth/login
{
    "email": "admin@example.com",
    "password": "password"
}
```

Response:
```json
{
    "message": "Login successful",
    "user": {...},
    "token": "1|..."
}
```

Use the token in Authorization header:
```
Authorization: Bearer {token}
```
