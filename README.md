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

### 3. Configure Environment Variables
##### Create a .env file by copying .env.example:

```bash
cp .env.example .env
```
#### Update your .env file with SQLite configuration and other necessary details:

### 4. PHP Configuration for SQLite
Ensure SQLite support is enabled in your PHP configuration:

1. Locate your php.ini file. This is usually found in your PHP installation directory.

2. Open php.ini and make sure the following extensions are uncommented:
   
```ini
extension=sqlite3
extension=pdo_sqlite
```
Remove the semicolon (;) at the beginning of these lines if present.

### 5. Generate Application Key
```bash
php artisan key:generate
```
This command generates a new encryption key for your application, essential for securing encrypted data.

### 6. Run Migrations and Seed Database

```bash
php artisan migrate --seed
```
- Migrations: Updates your database schema according to the migration files.
- Seeding: Populates your database with initial data (e.g., default records).

### 7. Install Sanctum and Set Up API
```bash
php artisan install:api
```
This command sets up Laravel Sanctum for API authentication.

### 8. Serve the Application
```bash
php artisan serve
```
Your application should now be running at http://localhost:8000.


## API Endpoints

### Public Routes

#### Register
##### POST /users

```json
{ 
  "name": "John Doe", 
  "email": "johndoe@example.com", 
  "password": "password", 
  "password_confirmation": "password" 
}
```
#### Login
##### POST /login

```json
{ 
  "email": "johndoe@example.com", 
  "password": "password" 
}
```

### Protected Routes (Authentication required)

| Endpoint                 | Method | Description                                      |
|--------------------------|--------|--------------------------------------------------|
| /books                   | GET    | Get list of all books (with pagination)         |
| /books                   | POST   | Add a new book (Admin/Librarian only)           |
| /books/{id}              | GET    | Get details of a specific book                  |
| /books/{id}              | PUT    | Update a book (Admin/Librarian only)            |
| /books/{id}              | DELETE | Delete a book (Admin only)                      |
| /authors                 | GET    | Get list of all authors (with pagination)       |
| /authors                 | POST   | Add a new author (Admin/Librarian only)         |
| /authors/{id}            | GET    | Get details of a specific author                |
| /authors/{id}            | PUT    | Update an author (Admin/Librarian only)         |
| /authors/{id}            | DELETE | Delete an author (Admin only)                   |
| /books/{book}/borrow     | POST   | Borrow a book (Authenticated users)             |
| /books/{book}/return     | POST   | Return a borrowed book                          |
| /borrow-records          | GET    | Get list of borrow records (Admin only)         |
| /borrow-records/{id}     | GET    | View details of a specific borrow record        |
| /logout                  | POST   | Logout a user                                   |



## Testing with Postman

### 1. **Import API Collection**:
   - Open Postman.
   - Click **Import** > **Link** and paste the following URL to import the API collection:

     [Postman Collection](https://github.com/joyelere/Library_Management_System/blob/da53c84bbbda232d73504bee7e4aec6dea64a7a2/postman/Library%20Management%20API.postman_collection.json)

### 2. **Authentication Setup**

- Register a user via the /users endpoint.
- Use the /login endpoint to obtain the token.
- In Postman, go to the Authorization tab and select Bearer Token. Paste the token from the login response.

### 3. **Test the API**

- **Register and Login:** Test user registration and login to obtain the authentication token.
- **Protected Routes:** Include the token in the Authorization header (Bearer <token>) for all protected routes.
- **Book Management:** Test adding, updating, and deleting books as an Admin or Librarian.
- **Author Management:** Test adding, updating, and deleting authors as an Admin or Librarian.
- **Borrowing & Returning Books:** Test the borrowing and returning system with authenticated users.
- **User Management:** As an Admin, test viewing and updating user details.

## License

This project is licensed under the [MIT License](LICENSE).

