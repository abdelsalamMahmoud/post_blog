# Blog Platform API – Laravel  + JWT Authentication

![Laravel](https://img.shields.io/badge/laravel-ff2d20?style=for-the-badge&logo=laravel&logoColor=white)
![JWT](https://img.shields.io/badge/JWT-black?style=for-the-badge&logo=json-web-tokens)
![MySQL](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

A fully functional **RESTful Blog Platform API** built with **Laravel**, featuring secure JWT authentication, role-based access control, full CRUD operations, advanced filtering, pagination, and comment system.

---

### Features

- JWT Authentication
- Role-based Authorization (Admin & Author)
- Full CRUD for Posts & Comments
- Advanced Search & Filtering on Posts
- Pagination with customizable per-page
- Laravel Policies for clean authorization
- Consistent JSON API responses
- Ready for frontend (Vue, React, etc.)

---

### Roles & Permissions

| Role   | ID | Permissions |
|--------|----|-----------|
| **Admin**  | `1` | Full access: create, update, delete **any** post/comment |
| **Author** | `0` | Can only manage their **own** posts/comments |

---

### Installation

```bash
git clone https://github.com/abdelsalamMahmoud/post_blog.git
cd post_blog
composer install
cp .env.example .env
php artisan key:generate
```

### Database Setup

#### 1-Create a MySQL database (e.g., blog_api)
#### 2-Update .env:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=root
DB_PASSWORD=
```

#### 3-Run migrations:

```bash
php artisan migrate
```

### JWT Setup

```bash
composer require php-open-source-saver/jwt-auth
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```

### Run Server

```bash
php artisan serve
```

### API Documentation

**Interactive Documentation**  
[View Full API Documentation on Postman](https://documenter.getpostman.com/view/33085841/2sB3dHVCZB)
*(Click to explore all endpoints with examples, auth, and test cases)*

**Local Postman Collection**  
Ready-to-import collection included in project root:  
`Blog Platform API Collection.json`  
→ Import into Postman and start testing instantly!

---
##### Advanced Filtering & Search (`GET /api/posts`)

You can **combine any of these query parameters** for powerful filtering:

| Parameter     | Example                                      | Description                              |
|---------------|----------------------------------------------|------------------------------------------|
| `search`      | `?search=Laravel`                            | Full-text search in **title**            |
| `category`    | `?category=Technology`                       | Filter by exact category name            |
| `author`      | `?author=5`                                  | Filter by author **ID**                  |
| `from` + `to` | `?from=2025-01-01&to=2025-12-31`             | Filter by creation date range            |
| `page`        | `?page=2`                                    | Pagination page                          |
| `per_page`    | `?per_page=25`                               | Items per page (max 100)                 |

**Real-World Examples:**

```http
GET /api/posts
→ All posts (default: 10 per page)

GET /api/posts?search=vue
→ Posts with "vue" in title

GET /api/posts?category=Technology&per_page=20
→ Tech posts, 20 per page

GET /api/posts?author=3&from=2025-01-01&to=2025-06-30
→ Posts by author ID 3 in first half of 2025

GET /api/posts?search=laravel&category=Tutorial&author=1&page=2
→ Laravel tutorials by author 1, page 2

GET /api/posts?search=php&per_page=50
→ 50 PHP-related posts per page
```
**Made with ❤️ using Laravel**  
by **Abdelsalam Mahmoud**