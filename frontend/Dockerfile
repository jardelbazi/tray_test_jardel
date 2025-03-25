# Usar uma imagem base do Node.js v23.10.0
FROM node:23.10.0-alpine

# Definir o diretório de trabalho dentro do container
WORKDIR /app

# Copiar os arquivos package.json e package-lock.json (se houver)
COPY package*.json ./

# Instalar o npm v11.2.0
RUN npm install -g npm@11.2.0

# Instalar as dependências da aplicação
RUN npm install

# Copiar o restante dos arquivos da aplicação para o container
COPY . .

# Expor a porta que a aplicação irá rodar
EXPOSE 8080

# Rodar a aplicação em modo de desenvolvimento
CMD ["npm", "run", "serve"]
