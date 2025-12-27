# Laravel Shopping Cart Application

This is a simple e-commerce shopping cart application built with **Laravel**, **Inertia.js**, and **Vue.js** as part of a technical assignment.

The goal of the project is to demonstrate:
- clean backend architecture
- separation of concerns
- proper use of Laravel features (queues, jobs, scheduler)
- authenticated cart handling (no sessions / localStorage)

---

## Tech Stack

- **Laravel**
- **Inertia.js**
- **Vue 3**
- **Tailwind CSS**
- **Laravel Breeze (auth scaffolding)**
- **MySQL**
- **Laravel Queue (database driver)**

---

## Features

- User authentication (login / register)
- Product browsing
- Shopping cart (persisted in database per authenticated user)
- Update / remove cart items
- Checkout flow
- Stock management
- Low stock email notifications
- Daily sales report email (scheduled job)

---

## Architecture Overview

The application follows a **thin controller** approach.

- **Controllers** handle HTTP requests and responses only
- **Action classes** encapsulate business logic
- Each Action represents a **single business operation**

### Example:
- `AddToCart` → adds a product to cart
- `CreateOrderFromCart` → handles checkout logic
- Controllers delegate work to Actions

This keeps the codebase:
- readable
- testable
- easy to extend


### Install backend dependencies:
composer install

### Install frontend dependencies
npm install

### Environment setup
cp .env.example .env
php artisan key:generate

### Example mail config (dummy email is sufficient for testing):
MAIL_MAILER=log
MAIL_ADMIN_EMAIL=admin@example.com


### Run migrations and seed data
php artisan migrate
php artisan db:seed


### Run the application
php artisan serve
npm run dev
