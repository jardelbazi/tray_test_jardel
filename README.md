# Tray Test Jardel

## Instalação do Projeto

Clone o repositório:
```sh
git clone https://github.com/jardelbazi/tray_test_jardel.git
cd tray_test_jardel
```

Suba os containers com Docker:
```sh
docker-compose up -d --build
```

Acesse o container do backend:
```sh
docker exec -it tray_backend bash
```

Renomeie o arquivo de exemplo do ambiente:
```sh
mv .env.example .env
```

Informar Google Client Id e Cliente Secret do Google Api Auth2:
```sh
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
```

Instale as dependências do Laravel:
```sh
composer install
```

gerar APP_KEY:
```sh
php artisan key:generate
```

Execute as migrações do banco de dados:
```sh
php artisan migrate
```

Para processar as filas
```sh
php artisan queue:work

```

## Configuração do Frontend

acesse a pasta do frontend:
```sh
cd frontend
```

Instale as dependências do Node.js:
```sh
npm install
```

## Sobre o Projeto
Desenvolvi utilizando alguns design patterns como adapters, factoies, interpreters, camadas de dto, service, repostitory, envio de emails com fila com event listeners. A parte dos testes não consegui finalizar e nem o front-end.
