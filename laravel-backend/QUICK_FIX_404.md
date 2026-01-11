# Quick Fix for 404 Errors

## The Problem
You're getting 404 errors because either:
1. Server is running from wrong directory
2. Routes cache is stale
3. Missing middleware files

## Solution (Do These Steps in Order)

### Step 1: Navigate to Laravel Directory
```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
```

### Step 2: Clear All Caches
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 3: Verify Routes
```bash
php artisan route:list | findstr "dashboard login"
```

You should see:
- GET /login
- GET /dashboard

### Step 4: Check if Files Exist
Make sure these files exist:
- `app/Http/Controllers/DashboardController.php` ✅
- `app/Http/Controllers/Auth/LoginController.php` ✅
- `app/Http/Middleware/Authenticate.php` ✅ (I just created this)
- `routes/web.php` ✅

### Step 5: Start Server FROM laravel-backend Directory
```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan serve
```

**CRITICAL:** Make sure you see:
```
INFO  Server running on [http://127.0.0.1:8000].
```

### Step 6: Test Routes
1. First try: `http://localhost:8000/login` (should work)
2. Then login and try: `http://localhost:8000/dashboard`

## If Still Getting 404

### Check Route List
```bash
php artisan route:list
```

Look for:
- `/login` (GET)
- `/dashboard` (GET)

If they're not there, the routes file isn't being loaded.

### Verify web.php is being loaded
Check `bootstrap/app.php` - it should have:
```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    ...
)
```

### Common Mistakes

❌ **WRONG:** Running `php artisan serve` from `agancy4` directory
✅ **CORRECT:** Running `php artisan serve` from `laravel-backend` directory

❌ **WRONG:** Accessing `http://localhost:8000/dashboard` without logging in first
✅ **CORRECT:** Access `http://localhost:8000/login` first, then dashboard

## Still Not Working?

Run this and share output:
```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan route:list --path=dashboard
php artisan route:list --path=login
```
