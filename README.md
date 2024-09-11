# Laravel Library Management System

This project is a **Library Management System** built with **Laravel 11** and **Laravel Sanctum** for user authentication. It allows users to borrow and return books, manage authors, track borrow records, and manage user data. The API supports both public routes for registration and login, and protected routes for managing books, authors, borrow records, and users.

## Features
- **Authentication:** Users can register, log in, and log out using Laravel Sanctum.
- **Book Management:** Admins and Librarians can manage books (add, update, delete, search, and view books).
- **Author Management:** Admins and Librarians can manage authors (add, update, delete, and view authors).
- **Borrowing System:** Users can borrow and return books, with borrow records being stored and managed by Admins.
- **User Management:** Admins can manage users (view, update, and delete users).
- **Role-based Authorization:** Role-based access control for actions like borrowing, returning books, or managing records.

## Requirements
- PHP 8.0+
- Composer
- MySQL or any compatible DB
- Postman (for testing API)
- Laravel 11
- Laravel Sanctum

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/joyelere/Library_Management_System.git
cd library-management-system
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 2. Install Dependencies
```bash
composer install
npm install
```
