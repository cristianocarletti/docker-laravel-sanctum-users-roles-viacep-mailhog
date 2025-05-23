# Laravel Sanctum Auth API com Recuperação de Senha e MailHog

## ✅ Requisitos
- Docker + Docker Compose
- Make ou terminal com comandos bash

---

## 🚀 Como iniciar o projeto com Docker

### 1. Clone o projeto e entre no diretório
```bash
cd nome-do-projeto
```

### 2. Crie o arquivo `.env`
```bash
cp .env.example .env
```

### 3. Crie o banco de dados SQLite
```bash
touch database/database.sqlite
```

### 4. Suba os containers
```bash
docker-compose up -d --build
```

### 5. Instale as dependências e gere a key do app
```bash
docker exec -it laravel bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8000
```
fora do bash:
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:refresh --seed
docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000

## 💻 Acessos rápidos
- **Frontend (login etc)**: http://localhost:8000

logins:
'name' => 'Admin',
'email' => 'admin@email.com',
'password' => bcrypt('123456'),
'role' => 'admin',

'name' => 'João da Silva',
'email' => 'joao@email.com',
'password' => bcrypt('123456'),
'role' => 'user',

- **MailHog (emails simulados)**: http://localhost:8025

---

## 📦 Estrutura principal
- Laravel 10 com Sanctum
- SQLite como banco de dados
- Recuperação de senha via e-mail (MailHog)
- Registro com preenchimento automático do endereço via ViaCEP
- Painel com autenticação e perfis `admin` e `user`
- Permissões protegidas com `is.admin`

---

## 🛠️ Funcionalidades principais

### 🔐 Autenticação
- Registro de usuário com endereço completo via CEP (ViaCEP)
- Login com retorno de token Sanctum
- Logout e middleware protegendo rotas

### 🧑‍💼 Perfis
- Perfil `admin`: acesso total, incluindo painel de usuários
- Perfil `user`: acesso apenas ao painel básico

### 📧 Recuperação de Senha
- Rota: `/forgot-password`
- Evento: `PasswordResetRequested`
- Listener assíncrono que envia e-mail com token
- Link leva à view `/reset-password` para nova senha

---

## 📜 Comandos úteis

### Migrate e Seed
```bash
php artisan migrate --seed
```

### Reset com fresh
```bash
php artisan migrate:fresh --seed
```

### Rodar servidor manual (caso necessário)
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### Rodar fila (listener de e-mail)
```bash
php artisan queue:work
```

---

## 🧪 Testes
```bash
php artisan test
```

---

## ✅ Considerações finais
- Sistema modular, seguindo princípios SOLID
- Usa Service Layer, Event/Listener, Contracts
- Requisições API-first + interface Blade
- Seguro e escalável

---

Desenvolvido com ❤️ usando Laravel + Docker + MailHog