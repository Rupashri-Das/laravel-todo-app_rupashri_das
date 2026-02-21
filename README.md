# Laravel To-Do Application

A full-stack Project and Task management system built for the Apollo Green Solutions technical assessment.

## Features

- **Authentication:** Secure user registration and login system.
- **Project Management:** Users can create and manage multiple personal projects.
- **Task Management:** Add tasks to projects, toggle completion status, and delete tasks.
- **Modern UI:** Responsive dashboard built with Laravel Breeze and Tailwind CSS.
- **Clean Architecture:** Implemented with latest-first sorting and optimized queries.

## Requirements

- PHP >= 8.2
- Composer
- MySQL Database

## Installation & Setup

1. **Clone the repository:**
```bash
    git clone https://github.com/Rupashri-Das/laravel_todo_app_rupashri_das.git
    cd laravel_todo_app_rupashri_das
```

2. **Install dependencies:**
```bash
    composer install
    npm install && npm run build
```

3. **Environment Setup:**
```bash
    cp .env.example .env
    php artisan key:generate
```

4. **Database Configuration:**

    Open the `.env` file and update your MySQL credentials:
```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
```

5. **Run Migrations:**
```bash
    php artisan migrate
```

6. **Run the Application:**
```bash
    php artisan serve
```
    Access the application at: http://127.0.0.1:8000

## Technical Highlights

- Built using **Laravel 11**.
- Optimized database queries using **Eager Loading** to prevent N+1 issues.
- Handled task sorting at the **Controller level** for a better user experience.
