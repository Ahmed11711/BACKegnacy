# Laravel Backend API

Complete Laravel backend API with authentication, CRUD operations, admin panel, and additional features.

## Installation

1. Install dependencies:
```bash
composer install
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Run migrations and seeders:
```bash
php artisan migrate --seed
```

5. Install Laravel Sanctum:
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

6. Create storage link:
```bash
php artisan storage:link
```

## Features

- Authentication with Laravel Sanctum
- Role-based access control (Admin/User)
- CRUD operations for all entities
- Admin panel APIs
- File uploads
- Activity logging
- Notifications system
- Search, filtering, and pagination
- Site settings management

## API Documentation

Base URL: `http://your-domain.com/api`

### Authentication Endpoints

- POST `/api/auth/register` - Register new user
- POST `/api/auth/login` - Login user
- POST `/api/auth/logout` - Logout user
- POST `/api/auth/forgot-password` - Request password reset
- POST `/api/auth/reset-password` - Reset password
- POST `/api/auth/email/verify` - Verify email
- POST `/api/auth/email/resend` - Resend verification email

### Protected Routes

All protected routes require Bearer token in Authorization header:
```
Authorization: Bearer {token}
```
