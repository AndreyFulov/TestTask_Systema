# Моё решение тестового задания от "Система"

Для данного задания я использовал чистый PHP с дополнением GD, а также базу данных MySQL.

ВАЖНО!
Все данные для входа в базу данных берутся из файла .env, пример его использования:
```env
DB_TYPE=mysql
DB_HOST=localhost
DB_LOGIN=root
DB_PORT=3306
DB_PASS=
DB_NAME=test_task_system
```

Для генерации таблицы используется команда

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    photo BLOB NOT NULL
);

```