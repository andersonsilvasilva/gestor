## Sistema Gestor de Prontuários de Atendimentos Ambulatoriais
# Autor: Anderson Antônio Barros e Silva
# URPICS Cuiabá - versão 1.1 - Ano 2025

## Requsitos para instalação da aplicação

* PHP 8.2 ou superior - conferir a versão: php -v
* composer - Conferir a implantação: composer --version
* Node.js 20 ou Superior - conferir a versão - node -v
* MySQL 8 ou Superior  - Conferir a versão: mysql --version
* Reports for PHP and Laravel 5.*, with JasperReports.
* Repositório: https://github.com/devmaster10/phpjasper-geekcom

## Sequecia para criar o projeto


## Como rodar o projeto baixado
Instalar as dependências do PHP
```
composer install
```

Instalar as dependências do Node.js
```
npm install
```

Duplicar o arquivo ".env.example" e renomear para ".env"
Alterar no arquivo .env o nome da base de dados para "celke". Exemplo: DB_DATABASE=celke

Gerar a chave
```
php artisan key:generate
```

Executar as migration
```
php artisan migrate
```

Executar as seed
```
php artisan db:seed
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Executar as bibliotecas Node.js
```
npm run dev
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000/
```

Sequencia para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel laravel-meu-projeto
```

Acessar op diretório onde está o projeto
```
cd laravel-meu-projeto
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000/
```

Criar Controller
```
php artisan make:controller NomeDaController
```
```
php artisan make:controller ContaController
```

Criar a VIEW
```
php artisan make:view nomeDaView
```
```
php artisan make:view contas/create
```

Criar a migration
```
php artisan make:migration create_contas_table
```

Executar as migration
```
php artisan migrate
```

Criar a model
```
php artisan make:model Conta
```

Criar o arquivo Request com validações
```
php artisan make:request ContaRequest
```

Criar seed
```
php artisan make:seeder ContaSeeder
```

Executar as seed para todos
```
php artisan db:seed
```
Executar  seed especifica
...
php artisan db:seed --class=AdminSeeder

Instalar o Vite
```
npm install
```

Instalar o framework Bootstrap
```
npm i --save bootstrap @popperjs/core
```

Instalar o sass
```
npm i --save-dev sass
```

Executar as bibliotecas Node.js
```
npm run dev
```

Instalar o  Bootstrap v4.1
```
composer require twbs/bootstrap:4.1.3
```

Instalando o repostorio do Vite
```
npm create vite@latest
npm install
npm run dev
```

