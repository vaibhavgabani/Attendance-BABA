<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🚀 Attendance-BABA Backend

This is the Laravel backend for the Attendance-BABA application, providing API endpoints for student attendance management.

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.x
- MySQL 8.0 or higher
- Node.js (for asset compilation)

## ⚡ Local Development Setup

### Clone and Setup

1. Clone the repository (if you haven't already):
   ```bash
   git clone https://github.com/vaibhavgabani/Attendance-BABA.git
   cd Attendance-BABA/Backend
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Create environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=attendance_baba
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. The API will be available at:
   ```
   http://localhost:8000/api
   ```

## 🧪 Testing

Run tests with:

```bash
php artisan test
```

## 📚 API Documentation

API routes are defined in the `routes/api.php` file. Main endpoints include:

- `GET /api/students` - List all students
- `POST /api/students` - Create a new student
- `GET /api/students/{id}` - Get a specific student
- `PUT /api/students/{id}` - Update a student
- `DELETE /api/students/{id}` - Delete a student

## 🔒 Authentication

The API uses Laravel Sanctum for authentication. To use protected endpoints:

1. Login using:
   ```
   POST /api/login
   ```

2. Include the returned token in subsequent requests as:
   ```
   Authorization: Bearer YOUR_TOKEN
   ```

## About Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
