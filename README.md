# Company Management System

A Laravel application with role-based access control for company management.

## Features

- User authentication (register, login, logout)
- Role-based access control (admin, manager, user)
- Company CRUD operations (restricted to admin and manager roles)

## Installation

1. Clone the repository
2. Install dependencies:
   ```
   composer install
   ```
3. Copy `.env.example` to `.env` and configure your database:
   ```
   cp .env.example .env
   ```
4. Generate application key:
   ```
   php artisan key:generate
   ```
5. Run migrations and seeders:
   ```
   php artisan migrate --seed
   ```
6. Start the development server:
   ```
   php artisan serve
   ```

## Default Users

The seeder creates the following default users:

- Admin: admin@example.com / password
- Manager: manager@example.com / password
- User: user@example.com / password

## Access Control

- Admin and Manager roles can access company management features
- User role cannot access company management features
