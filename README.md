# api mediaw

## instalação

git clone https://github.com/fabiovige/api-mediaw

cd api-mediaw

docker compose up -d

docker exec mediaw-app bash

composer install

php artisan key:generate

php artisan migrate

## endpoints

[GET] http://api-mediaw.test/api/v1/companies
[POST] http://api-mediaw.test/api/v1/companies
[GET] http://api-mediaw.test/api/v1/companies?page=1&filter[company]=ltda
[GET] http://api-mediaw.test/api/v1/refresh
[POST] http://api-mediaw.test/api/v1/login

