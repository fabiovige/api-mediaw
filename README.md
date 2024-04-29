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

Obtem uma api_token
[GET] http://api-mediaw.test/api/v1/company-authentication 

Lista as companias
[GET] http://api-mediaw.test/api/v1/companies

Atualiza o token
[GET] http://api-mediaw.test/api/v1/refresh-token

Exibe os dados do token "demonstração"
[GET] http://api-mediaw.test/api/v1/payload-token

Adiciona uma nova compania
[POST] http://api-mediaw.test/api/v1/companies 

Realiza login
[POSt] http://api-mediaw.test/api/v1/login 

Encerra a sessão e exclui os tokens
[GET] http://api-mediaw.test/api/v1/logout 

Consulta companias com filtro
[GET] http://api-mediaw.test/api/v1/companies?page=1&filter[company]=Padilha 

Lista todas os pedidos (pagarme)
[GET] http://api-mediaw.test/api/v1/service-orders-list

Lista um pedido (pagarme)
[POST] http://api-mediaw.test/api/v1/service-order

Consulta um item de pedido (pagarme)
[POST] http://api-mediaw.test/api/v1/service-order-item

Cadastra um novo pedido (pagarme)
[POST] http://api-mediaw.test/api/v1/service-orders-create

Adiciona um novo item ao pedido (pagarme)
[POST] http://api-mediaw.test/api/v1/service-order-add-item/or_B32Xq00upSjwQZqY

Fecha um pedido (pagarme)
[PATCH] http://api-mediaw.test/api/v1/service-order-close/or_EOzypD4t6hApn8D9