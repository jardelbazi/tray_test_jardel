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

Instale as dependências do Laravel:
```sh
composer install
```

Execute as migrações do banco de dados:
```sh
php artisan migrate
```

## Configuração do Frontend

Saia do container e acesse a pasta do frontend:
```sh
cd frontend
```

Instale as dependências do Node.js:
```sh
npm install
```

