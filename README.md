# Curotec Product Management API

A Laravel-based API and web interface for managing products and categories.

---

## 🚀 Getting Started

Follow the steps below to set up the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/rodolfofernandes/curotec.git
cd curotec
```

### 2. Configure Environment

Rename the `.env.example` file to `.env`:

```bash
mv .env.example .env
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Configure Database

Edit the `.env` file with your database credentials. Example for PostgreSQL:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=admin
DB_PASSWORD=admin
```

### 5. Build and Start Docker

```bash
docker-compose up --build
```

### 6. Generate Application Key

Once the application is running, visit:

```
http://localhost:8000
```

Then generate the application key:

```bash
php artisan key:generate
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed the Database

Run the following seeders:

```bash
php artisan db:seed --class=CategoryProductTableSeeder
php artisan db:seed --class=CategoryTableSeeder
php artisan db:seed --class=ProductTableSeeder
```

---

## 📦 API Endpoint

### GET `/api/products`

Query Parameters:

- `product_id`
- `name`
- `color`
- `price_min`
- `category_id`
- `per_page` (number of results per page)

**Example:**

```
http://localhost:8000/api/products?product_id=1
```

---

## 🖥️ Web Interface

Visit the following route to create a new product:

```
http://localhost:8000/products/create
```

---

## ✅ Running Tests

To execute the test suite, run:

```bash
php artisan test
```

---

## 🛠️ Tech Stack

- Laravel 10
- PostgreSQL 15
- Docker & Docker Compose

---

## 📄 License

This project is open-source and available under the [MIT license](LICENSE).