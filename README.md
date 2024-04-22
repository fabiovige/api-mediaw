# api mediaw

## instalação

git clone https://github.com/fabiovige/api-mediaw

cd api-mediaw

docker compose up -d

docker exec mediaw-app bash

composer install

php artisan key:generate

php artisan migrate

http://api-mediaw.test/

