# CRUD com Laravel + Vue + MySql
Bem-vindo ao Projeto CRUD Laravel + Vue + MySql! Siga os passos abaixo para configurar e executar o projeto localmente.

## Requisitos

Certifique-se de ter as seguintes ferramentas instaladas antes de começar:

- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## Configuração do Ambiente

### -> Faça o download ou clone do projeto
### -> Abrir terminal no diretório do projeto
### -> Executar comando: composer install
### -> Executar comando: npm install
### -> Executar comando: cp .env.example .env
### -> Executar comando: php artisan key:generate
### -> Abrir o arquivo .env e ajustar configurações próprias do MySql
### -> Executar comando: php artisan migrate
### -> Em caso de erro: php artisan migrate:fresh
### -> Executar comando: php artisan db:seed --class=TransportadoraSeeder
### -> Executar comando: php artisan serve
