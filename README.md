
# Top-Up Diamond Game Web Application

## Description
This project is a web-based application for purchasing game top-up credits (diamonds) built with CodeIgniter 4. It was developed as a final project (UAS) for the Web Programming course at university. The application allows users to browse games, select top-up options, manage transactions, and provides an admin dashboard for managing users, games, payment methods, and sales records.

**GitHub Repo Description:**
> A CodeIgniter 4 web application for game top-up transactions, built as a final project for the "Pemrograman Website" course. Features user registration, game catalog, payment methods, transaction history, and admin dashboard.

## What is this project?
A full-featured web platform for digital game top-up transactions. Users can register, log in, browse available games, choose top-up packages, and pay using various payment methods. Admins can manage all entities and view transaction histories.

## Why was it built?
This project was created to fulfill the requirements of the "Pemrograman Website" (Web Programming) course UAS (final exam/project). It demonstrates practical skills in PHP, CodeIgniter 4, MVC architecture, CRUD operations, validation, and secure web development.

## Who is it for?
- **Students** learning web development with PHP and CodeIgniter
- **Instructors** seeking a reference project for teaching
- **Anyone** interested in building a digital product e-commerce platform

## How does it work?
- **Users** can:
  - Register and log in
  - Browse games and top-up options
  - Make transactions and view their transaction history
- **Admins** can:
  - Manage users, games, top-up options, and payment methods
  - View and manage all transactions
  - Prevent deletion of entities that are referenced in transactions
- **Validation** is enforced both on the frontend and backend for all forms and transactions
- **Dependency checks** prevent deletion of games, users, or payment methods if they are used in any transaction

## Features
- User registration and authentication
- Game catalog with top-up options
- Multiple payment methods
- Transaction history for users
- Admin dashboard for CRUD management
- Form validation and user feedback
- Secure deletion with dependency checks

## Installation & Running Locally

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- [Laragon](https://laragon.org/) or XAMPP/WAMP (recommended for Windows)

### Steps
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd top-up-diamond-UAS-PEMWEB
   ```
2. **Install dependencies:**
   ```bash
   composer install
   ```
3. **Set up the environment:**
   - Copy `.env.example` to `.env` (if available) and configure your database settings, or edit `app/Config/Database.php`.
   - Create a new MySQL database (e.g., `topup_db`).
   - Import the SQL schema from `app/Database/toko_top_up_game.sql`.
4. **Set writable permissions:**
   - Ensure the `writable/` directory and its subfolders are writable by the web server.
5. **Run the development server:**
   ```bash
   php spark serve
   ```
   Or use your local web server (Laragon/XAMPP) and point the document root to the `public/` folder.
6. **Access the application:**
   - Open your browser and go to `http://localhost:8080` (or your configured local domain).

## Author
This project was created by [Your Name] as a final project for the Web Programming (Pemrograman Website) course.

---

For more information, see the code and comments in each module. Contributions and feedback are welcome!
