# How to Access the Admin Dashboard

## Overview

The dashboard is an **API endpoint** that returns JSON data (not a web page). It requires:
1. ✅ Authentication (Bearer token)
2. ✅ Admin role

**Endpoint:** `GET /api/admin/dashboard`

---

## Step-by-Step Guide

### Step 1: Ensure Laravel Project is Set Up

If you haven't set up the Laravel project yet, you need to:

1. **Create a Laravel project** (if you don't have one):
```bash
cd C:\laragon\www\new-company
composer create-project laravel/laravel my-api
cd my-api
```

2. **Copy files** from `laravel-backend/` into the new project

3. **Install Sanctum**:
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

4. **Run migrations and seeders**:
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

5. **Start the server**:
```bash
php artisan serve
```

Server will run at: `http://localhost:8000`

---

### Step 2: Login as Admin to Get Token

**Default Admin Credentials:**
- Email: `admin@example.com`
- Password: `password`

#### Using Postman/Insomnia/Thunder Client:

**Request:**
```
POST http://localhost:8000/api/auth/login
Content-Type: application/json

{
    "email": "admin@example.com",
    "password": "password"
}
```

**Response:**
```json
{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@example.com",
        "role": "admin",
        ...
    },
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

**Copy the `token` value** - you'll need it in the next step.

---

### Step 3: Access the Dashboard

#### Using Postman/Insomnia/Thunder Client:

**Request:**
```
GET http://localhost:8000/api/admin/dashboard
Authorization: Bearer {your_token_here}
Content-Type: application/json
```

Replace `{your_token_here}` with the token you got from Step 2.

**Response:**
```json
{
    "data": {
        "total_users": 11,
        "active_users": 11,
        "total_orders": 0,
        "pending_orders": 0,
        "total_products": 18,
        "active_products": 18,
        "total_categories": 8
    }
}
```

---

## Using cURL (Command Line)

### Step 1: Login
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"admin@example.com\",\"password\":\"password\"}"
```

Save the token from the response.

### Step 2: Access Dashboard
```bash
curl -X GET http://localhost:8000/api/admin/dashboard \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json"
```

---

## Using Browser (JavaScript/Fetch)

If you're building a frontend, use this code:

```javascript
// 1. Login first
const loginResponse = await fetch('http://localhost:8000/api/auth/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        email: 'admin@example.com',
        password: 'password'
    })
});

const loginData = await loginResponse.json();
const token = loginData.token;

// 2. Access dashboard
const dashboardResponse = await fetch('http://localhost:8000/api/admin/dashboard', {
    method: 'GET',
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
    }
});

const dashboardData = await dashboardResponse.json();
console.log(dashboardData.data); // Dashboard statistics
```

---

## Quick Test Script (PHP)

Create a file `test-dashboard.php` in your Laravel project root:

```php
<?php

$baseUrl = 'http://localhost:8000/api';

// Step 1: Login
$loginData = [
    'email' => 'admin@example.com',
    'password' => 'password'
];

$ch = curl_init($baseUrl . '/auth/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($loginData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$loginResult = json_decode($response, true);
$token = $loginResult['token'] ?? null;

if (!$token) {
    die("Login failed!\n");
}

echo "Login successful! Token: " . substr($token, 0, 20) . "...\n\n";

// Step 2: Get Dashboard
$ch = curl_init($baseUrl . '/admin/dashboard');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$dashboard = json_decode($response, true);

echo "Dashboard Statistics:\n";
echo "====================\n";
print_r($dashboard['data']);
```

Run with:
```bash
php test-dashboard.php
```

---

## Troubleshooting

### Error: "Unauthenticated"
- Make sure you're including the `Authorization: Bearer {token}` header
- Check if the token is valid and not expired
- Try logging in again to get a fresh token

### Error: "Unauthorized. Admin access required."
- Make sure you logged in with an admin account (`admin@example.com`)
- Check the user's role in the database

### Error: "Route not found"
- Make sure the Laravel server is running (`php artisan serve`)
- Check the API routes are registered (`php artisan route:list`)
- Verify the route path is correct: `/api/admin/dashboard`

### Error: "500 Internal Server Error"
- Check Laravel logs: `storage/logs/laravel.log`
- Make sure migrations are run: `php artisan migrate`
- Make sure seeders are run: `php artisan db:seed`

---

## Dashboard Endpoint Details

**URL:** `GET /api/admin/dashboard`

**Authentication:** Required (Bearer token)

**Role Required:** Admin

**Response:**
```json
{
    "data": {
        "total_users": 11,
        "active_users": 11,
        "total_orders": 0,
        "pending_orders": 0,
        "total_products": 18,
        "active_products": 18,
        "total_categories": 8
    }
}
```

---

## Additional Admin Endpoints

After accessing the dashboard, you can also access:

- `GET /api/admin/users` - List all users
- `PUT /api/admin/users/{id}` - Update user
- `GET /api/admin/activity-logs` - View activity logs
- `POST /api/admin/products` - Create product
- `PUT /api/admin/products/{id}` - Update product
- `DELETE /api/admin/products/{id}` - Delete product
- And more...

All require the same authentication (Bearer token) and admin role.
