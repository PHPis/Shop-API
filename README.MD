# Окружение
Базовое окружение копируем из репозитория https://github.com/PHPis/docker-php8.git
## Докер состоит из:
- PHP - 8 (+ composer)
- NGINX - 1.16.0-alpine
- Postgres
- Adminer

## Команда запуска
```bash
docker-compose up -d
```

## Прочие команды 
Просмотр контейнеров:
```bash
docker ps
```
Просмотр логов:
```bash
docker logs Имя_контейнера(shopapi_engine_1)
```
Зайти из-под контейнера:
```bash
docker-compose exec engine bash
```
Перезапустить контейнер:
```bash
docker-compose restart nginx
```

## Make-файл
Make-файл - это краткий вызов одной или нескольких команд, прописанных в Makefile. 

# Создание проекта

##Установка и запуск из-под докера
Установка симфони из-под докера:
```bash
docker-compose exec engine bash
composer create-project symfony/skeleton my_project_directory
```
Проверить права доступов к файлам, если нет, то выдать(из-под докера можно):
```bash
ls -l
chown -R www-data my_project_directory/
```
Переместить файлы в основную директорию:
```bash
sudo mv -i my_project_directory/* .
```
Объединение переменных окружения и игнорируемых гитом файлов:
```bash
cat my_project_directory/.env >> .env.example
cat my_project_directory/.env >> .env
cat my_project_directory/.gitignore >> .gitignore
```
Удаляем, директория my_project_directory больше не нужна
```bash
rm -R my_project_directory/
```
Изменим путь корневой у nginx в файле - docker/nginx/default.conf на:
```
root /var/www/html/public;
```
Перезапустить контейнер:
```bash
docker-compose restart nginx
```

Симфони готов к работе.

##Установка бандлов

```
composer require symfony/flex
composer require symfony/maker-bundle --dev
composer require symfony/security-bundle
composer require doctrine/doctrine-bundle
composer require doctrine/doctrine-migrations-bundle
```

Самый простой способ создать пользовательский класс — использовать команду make:user из MakerBundle:
```
php bin/console doctrine:database:create
php bin/console make:user
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

```
composer require zenstruck/foundry --dev
composer require --dev orm-fixtures
```
При добавлении авторизации по токену, если логин в сущности User именуется не как "username", то надо прописать 
именование поля в ```login_path: email```.
