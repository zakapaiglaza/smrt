# Mini CRM

Система для збору та обробки заявок з сайту через універсальний віджет.

## Стек

- Laravel 11, PHP 8.4
- MySQL 8
- Docker, Nginx
- spatie/laravel-permission
- spatie/laravel-medialibrary

## Запуск

1. Склонувати репозиторій

```
git clone git@github.com:zakapaiglaza/smrt.git
cd smrt
```

2. Скопіювати .env

```
cp .env.example .env
```

3. Підняти докер

```
docker compose up -d --build
```

4. Виконати міграції та сіди

```
docker compose exec app php artisan migrate --seed
```

5. Створити symlink для storage

```
docker compose exec app php artisan storage:link
```

6. Перейти http://localhost:8000

Тестові данні для входу в адмін панель

- Email: test@gmail.com
- Пароль: 1234567890

## Сторінки

- /login — вхід в адмін панель
- /admin/tickets — список заявок
- /admin/tickets/{id} — деталі заявки
- /widget — форма зворотного зв'язку для клієнтів

## API

### Створення заявки

```
POST /api/tickets
Content-Type: multipart/form-data
```

Поля:

name: string|required
phone: string|required|format: +380991234567
email: string|required
subject: string|required
body: string|required
files[]: file|nullable|jpg,png,pdf,doc,txt|max:10MB


Ліміт: 1 заявка на день з одного номера телефону або email.

### Статистика заявок

```
GET /api/tickets/statistics
```

## Вставка віджету на інший сайт

```html
<iframe src="http://your-domain.com/widget" width="520" height="650" frameborder="0"></iframe>
```
