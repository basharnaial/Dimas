# Laravel Sanctum Setup Guide - دليل إعداد Laravel Sanctum

## ✅ What's Already Done - ما تم إنجازه:

1. **Sanctum Package**: Installed via Composer ✅
2. **User Model**: Added `HasApiTokens` trait ✅
3. **CORS Configuration**: Updated for SPA support ✅
4. **API Routes**: Protected admin routes with Sanctum ✅
5. **AuthServiceProvider**: Created with `manage-catalog` gate ✅
6. **Migration**: Created for `is_admin` column ✅
7. **AuthController**: Created for API authentication ✅

## 🚀 Next Steps - الخطوات التالية:

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Create Admin User
```bash
php artisan tinker
```

```php
$user = \App\Models\User::factory()->create([
    'email' => 'admin@demas.test',
    'password' => bcrypt('secret123'),
    'is_admin' => true,
]);
```

### 3. Test API Authentication

#### Login to get token:
```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@demas.test",
    "password": "secret123",
    "device_name": "Postman"
  }'
```

#### Use token for protected routes:
```bash
curl -X POST http://localhost:8000/api/v1/products \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test Product",
    "slug": "test-product",
    "short_description": "Test description"
  }'
```

## 🔧 Configuration Files - ملفات الإعداد:

### CORS (config/cors.php)
- ✅ `supports_credentials: true`
- ✅ `allowed_origins: [env('FRONTEND_URL')]`
- ✅ `paths: ['api/*', 'login', 'logout', 'sanctum/csrf-cookie']`

### Sanctum (config/sanctum.php)
- ✅ `stateful` domains configured
- ✅ `guard: ['web']`
- ✅ Middleware configured

### Environment Variables (.env)
```env
FRONTEND_URL=http://localhost:5173
SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173
SESSION_DOMAIN=localhost
```

## 🎯 API Endpoints - نقاط النهاية:

### Public (عامة):
- `GET /api/v1/categories` - List categories
- `GET /api/v1/categories/{slug}` - Show category
- `GET /api/v1/products` - List products
- `GET /api/v1/products/{slug}` - Show product
- `POST /api/v1/contact` - Send contact message

### Authentication (مصادقة):
- `POST /api/v1/login` - Login and get token
- `POST /api/v1/logout` - Logout (requires auth)
- `GET /api/v1/user` - Get current user (requires auth)

### Admin Only (إداري فقط):
- `POST /api/v1/categories` - Create category
- `PUT/PATCH /api/v1/categories/{slug}` - Update category
- `DELETE /api/v1/categories/{slug}` - Delete category
- `POST /api/v1/products` - Create product
- `PUT/PATCH /api/v1/products/{slug}` - Update product
- `DELETE /api/v1/products/{slug}` - Delete product

## 🔒 Security Features - ميزات الأمان:

1. **Token-based Authentication**: Personal access tokens
2. **Admin Gate**: Only admin users can manage catalog
3. **CORS Protection**: Configured for SPA
4. **Route Protection**: Middleware-based access control

## 🧪 Testing - اختبار:

### Test Admin Access:
1. Login with admin user
2. Try to create/update/delete products/categories
3. Verify non-admin users are blocked

### Test Public Access:
1. Verify public endpoints work without authentication
2. Test search and filtering functionality

## 📝 Notes - ملاحظات:

- All admin routes require both `auth:sanctum` and `can:manage-catalog`
- Tokens are created per device name
- CORS is configured for SPA with credentials support
- Admin status is checked during login and route access

## 🚨 Troubleshooting - حل المشاكل:

### Common Issues:
1. **CORS errors**: Check `FRONTEND_URL` and `SANCTUM_STATEFUL_DOMAINS`
2. **Unauthorized**: Verify user has `is_admin = true`
3. **Token invalid**: Check token format and expiration
4. **Migration failed**: Run `php artisan migrate:status`

### Commands:
```bash
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan migrate:status
```
