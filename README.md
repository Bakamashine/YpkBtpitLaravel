# YPK BTPIT Laravel

Laravel-based backend API for the YPK (УПК) management system.

## Requirements

- PHP >= 8.3
- Composer
- PostgreSQL
- Node.js & NPM

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy environment file and configure:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Configure database connection in `.env`:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
6. Run migrations:
   ```bash
   php artisan migrate
   ```
7. Build assets:
   ```bash
   npm run build
   ```

## Features

- **Authentication**: Laravel Fortify with 2FA support
- **API Tokens**: Laravel Sanctum
- **UUID Primary Keys**: All models use UUIDs
- **Role-based Access Control**: Users have roles (Admin, Manager, DefaultUser)
- **YPK Management**: YPK entities with products and statuses
- **Order Management**: Orders with status tracking
- **Feedback System**: User feedback with ratings
- **Selected Products**: User product selections/favorites

## Database Schema

### Tables

| Table               | Description                                          |
|---------------------|------------------------------------------------------|
| `roles`             | User roles (Admin, Manager, DefaultUser)             |
| `ypks`              | YPK entities                                         |
| `status_orders`     | Order status definitions                             |
| `status_products`   | Product status definitions                           |
| `users`             | User accounts with roles and optional YPK assignment |
| `products`          | Products linked to YPKs and users                    |
| `feedbacks`         | User feedback with ratings                           |
| `orders`            | Orders with customer, executor, and product          |
| `selected_products` | User's selected/favorite products                    |

## Models

- `User` - User authentication and profile
- `Role` - User roles
- `Ypk` - YPK entities
- `StatusOrder` - Order statuses
- `StatusProduct` - Product statuses
- `Product` - Products
- `Feedback` - User feedback
- `Order` - Orders
- `SelectedProduct` - Selected products

## Form Requests

Each model has `Store{Model}Request` and `Update{Model}Request` for validation.

## Authentication

This project uses Laravel Fortify for authentication. Available features:

- Login / Logout
- Registration
- Password Reset
- Email Verification (disabled by default)
- Two-Factor Authentication (2FA)
- Passkeys

Configure Fortify features in `config/fortify.php`.

## Development

Run development server:

```bash
composer run dev
```

Run tests:

```bash
composer run test
```

Code style:

```bash
vendor/bin/pint
```
