# Laravel Library API

Это RESTful API для системы управления библиотекой, разработанное на Laravel. Оно предоставляет аутентификацию с использованием JWT для двух типов пользователей: **Библиотекари** и **Пользователи**.

## Возможности
- **Пользователи** могут:
  - Просматривать доступные книги
  - Брать книги
  - Возвращать книги
- **Библиотекари** могут:
  - Добавлять новые книги
  - Редактировать информацию о книгах
  - Удалять книги
  - Просматривать все книги

## Предварительные требования
Перед началом убедитесь, что у вас установлены:
- PHP 8+
- Composer
- MySQL (или другая база данных на ваш выбор)
- Laravel 10+

## Установка

### 1. Клонирование репозитория
```bash
git clone <repository_url>
cd <project_directory>
```

### 2. Установка зависимостей
```bash
composer install
```

### 3. Настройка окружения
Переименуйте файл `.env.example` в `.env` и обновите данные для подключения к базе данных:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 4. Генерация ключа приложения
```bash
php artisan key:generate
```

### 5. Настройка JWT-аутентификации
```bash
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```

### 6. Запуск миграций
```bash
php artisan migrate
```

### 7. Запуск сервера
```bash
php artisan serve
```
API будет доступно по адресу `http://127.0.0.1:8000`.

## Аутентификация

### Маршруты для пользователей
- **Регистрация:** `POST /api/register`
- **Вход:** `POST /api/login`
- **Выход:** `POST /api/logout`

### Маршруты для библиотекарей
- **Создание библиотекаря (только через консоль):**
  ```bash
  php artisan librarian:create
  ```
- **Вход:** `POST /api/librarian/login`
- **Выход:** `POST /api/librarian/logout`

## Управление книгами

### Действия пользователей
- **Просмотр доступных книг:** `GET /api/books`
- **Взять книгу:** `POST /api/books/borrow/{id}`
- **Вернуть книгу:** `POST /api/books/return/{id}`

### Действия библиотекарей
- **Добавить книгу:** `POST /api/books`
- **Обновить информацию о книге:** `PUT /api/books/{id}`
- **Удалить книгу:** `DELETE /api/books/{id}`
- **Просмотреть все книги:** `GET /api/books`

## Заголовки запросов
Все API-запросы, требующие аутентификации, должны включать JWT-токен:
```http
Authorization: Bearer <your_token>
```

## Лицензия
Этот проект является open-source и распространяется по лицензии MIT.

