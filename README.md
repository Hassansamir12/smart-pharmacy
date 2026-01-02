# Smart Pharmacy Management & Expiry Alert System (CMPE 410)

A multi-user web application built with Laravel to manage pharmacy inventory and automatically track medicine expiry dates with alerts.

## Project Requirements (CMPE 410)
- Complete web application
- Multi-user
- Authentication + authorization
- At least 2 user types (Admin, Staff)
- Responsive modern UI
- Full project code + database export + simple documentation

## Core Features
- Authentication (login/logout).
- Authorization / roles:
  - Admin: can manage users and sensitive actions.
  - Staff: can use daily operations features based on permissions.
- Pharmacy management:
  - Manage medicines/products.
  - Manage suppliers.
  - Manage batches/stock with expiry dates.
- Expiry alert system:
  - View near-expiry / expired items.
  - “breeze download” / restricted download feature (protected by authorization).
- Admin tools:
  - User role management (only Admin can grant Admin role).

## Tech Stack
- Laravel (PHP)
- MySQL / MariaDB
- Blade + Tailwind 
- Vite / npm for frontend assets

## Installation (Local)
### 1) Requirements
- PHP 8+
- Composer
- Node.js + npm
- MySQL/MariaDB (Laragon recommended)

### 2)setup

# 1) Go to your project folder
cd path/to/your-project

# 2) Install PHP dependencies
composer install

# 3) Create .env file
cp .env.example .env

# 4) Generate app key
php artisan key:generate

# 5) IMPORTANT: create DB in phpMyAdmin, then edit .env:
# DB_DATABASE=pharmacy
# DB_USERNAME=root
# DB_PASSWORD=

# 6) Install Laravel Breeze (auth)
composer require laravel/breeze --dev
php artisan breeze:install

# 7) Run migrations
php artisan migrate
# (optional, if you have seeders)
# php artisan migrate:fresh --seed

# 8) Frontend assets
npm install
npm run dev

# 9) Run the project
php artisan serve

