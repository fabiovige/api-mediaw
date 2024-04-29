# api mediaw

## instalação

git clone git@github.com:fabiovige/api-mediaw.git api-media

cd api-media

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=mediaw_db
DB_USERNAME=root
DB_PASSWORD=root

docker compose up -d

docker exec -it mediaw-app bash

composer install

php artisan key:generate

php artisan migrate:refresh --seed


# windows - adicione ao arquivo hosts
C:\Windows\System32\drivers\etc
127.0.0.1 api-mediaw.test

# linux - adicione ao arquivo hosts
sudo nano /etc/hosts
127.0.0.1 api-mediaw.test

acesse: http://api-mediaw.test


