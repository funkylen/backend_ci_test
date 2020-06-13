# Настройка окружения

Для работы с приложением необходим Docker и docker-compose

Запуск приложения:
`
docker-compose up -d
`

Миграция:
1. Зайти в *mysql*
`
docker-compose exec db mysql -u root -ppassword
`
2. Выгрузить дамп:
`
use backend_ci_test; source /tmp/dump.sql;
`

Приложение будет доступно по адресу:
`
http://127.0.0.1:8080/
`
