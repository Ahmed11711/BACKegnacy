# Fix 404 Error - Dashboard Not Found

## Quick Fix Steps

### Step 1: Make sure you're running the server from the Laravel project directory

```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan serve
```

**IMPORTANT:** The server must be running from inside the `laravel-backend` directory, not the parent `agancy4` directory.

### Step 2: Clear route cache

```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### Step 3: Check if routes are registered

```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan route:list | findstr dashboard
```

You should see the dashboard route in the list.

### Step 4: Check if the Controller exists

Make sure this file exists:
```
laravel-backend/app/Http/Controllers/DashboardController.php
```

### Step 5: Verify the web routes file

Make sure your `routes/web.php` file has the dashboard route. It should be at:
```
laravel-backend/routes/web.php
```

## Common Issues

### Issue 1: Running server from wrong directory
**Symptom:** 404 on all routes
**Solution:** Always run `php artisan serve` from the `laravel-backend` directory

### Issue 2: Routes not loaded
**Symptom:** Routes not showing in `php artisan route:list`
**Solution:** 
```bash
php artisan route:clear
php artisan config:clear
```

### Issue 3: Controller class not found
**Symptom:** Error: Class 'App\Http\Controllers\DashboardController' not found
**Solution:** Make sure the file exists and namespace is correct

### Issue 4: Authentication middleware not working
**Symptom:** Redirect loops or authentication errors
**Solution:** Make sure you're logged in, or access `/login` first

## Quick Test

1. **Start the server from the correct directory:**
```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan serve
```

2. **Try accessing the login page first:**
```
http://localhost:8000/login
```

3. **If login page works, login with:**
- Email: admin@example.com
- Password: password

4. **Then try the dashboard:**
```
http://localhost:8000/dashboard
```

## Still Getting 404?

Run these commands and share the output:

```bash
cd C:\laragon\www\new-company\agancy4\laravel-backend
php artisan route:list
php artisan about
```
