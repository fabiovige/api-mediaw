# MediaW - Demonstração de API para consumo do Pagarme

## clonar o projeto

```
git clone git@github.com:fabiovige/api-mediaw.git api-media

cd api-media

cp .env.example .env
```

## configurando .env

- informe ao laravel que a aplicação será uma API
AUTH_GUARD=api

- configuracao do banco de dados
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=mediaw_db
DB_USERNAME=root
DB_PASSWORD=root

## subindo o container

```
docker compose up -d
```

## acessando o container

```
docker exec -it mediaw-app bash
```

## instalando as dependencias

```
composer install
```

## gerando uma key da aplicação

```
php artisan key:generate
```

## rodando as migrations para criar as tabelas do banco

```
php artisan migrate:refresh --seed
```

## gerando a chave jwt secret

```
php artisan jwt:secret
```

## configurando DNS para acesso ao sistema

### windows - adicione ao arquivo hosts

```
C:\Windows\System32\drivers\etc
127.0.0.1 api-mediaw.test
```

### linux - adicione ao arquivo hosts

```
sudo nano /etc/hosts
127.0.0.1 api-mediaw.test
```


## Acessando o sistema: http://api-mediaw.test

## Endpoints


