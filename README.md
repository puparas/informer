В случае если вы собираетесь запустить на локальной машине:
Прежде всего сделайте копию файла .env.example и переименуйте в .env
После чего выполните в консоли команду:
`php artisan jwt:secret`
Также добавьте в файл 3 параметра:
`DB_DATABASE=informer_db
DB_USERNAME=informer_user
DB_PASSWORD=informer_user`
После этого:
`docker-compose up` - запускаем докер контейнеры

ВНИМАНИЕ!!!
Если вы запускаете **первый** раз. 
1. Зайдите по урлу (`http://127.0.0.1:8000`) или ваш домен `/storage`. 
Это нужно для создания симлинка на storage. Иначе картинки отвалятся.
2. Вам необходимо сделать миграции базы данных
`docker exec -it  relevant_informer-php-1 php artisan migrate`
3. Создать администратора
`docker exec -it  relevant_informer-php-1 php artisan db:seed --class=AdminUserSeeder`
с доступами `admin@relevant.ru` `relevant`

Проверяем работу на **http://127.0.0.1:8000** или **http://localhost:8000**
