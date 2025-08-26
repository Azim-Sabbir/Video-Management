# Video CRUD API

A Laravel-based REST API for managing videos with file upload functionality for thumbnails.

## Features

- **Video Management**: Create, read, and list videos
- **File Upload**: Upload and manage video thumbnails with validation
- **Category Filtering**: Filter videos by category
- **Image Processing**: Automatic thumbnail URL generation
- **Validation**: Comprehensive input validation for all fields
- **Clean Architecture**: Service layer pattern with DTOs

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL database

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd vide-crud
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install


### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment

Edit the `.env` file and configure your database and other settings:

```env
APP_NAME="Video CRUD API"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=video_crud
DB_USERNAME=your_username
DB_PASSWORD=your_password

# File storage configuration
FILESYSTEM_DISK=local
```

### 5. Database Setup

```bash
# Create database (if using MySQL)
mysql -u root -p -e "CREATE DATABASE video_crud;"

# Run migrations
php artisan migrate

# Create storage symbolic link
php artisan storage:link
```

### 6. Start the Development Server

```bash
# Option 1: Laravel built-in server
php artisan serve

# Option 2: Use Laravel's dev script (includes queue, logs, and vite)
composer run dev
```

The API will be available at `http://localhost:8000`

## API Documentation

### Base URL
```
http://localhost:8000/api/v1
```
