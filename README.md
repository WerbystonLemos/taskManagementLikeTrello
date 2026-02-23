# Task Management Like Trello

Desafio técnico para VOX

## 👨🏾‍💻Notas do desenvolvedor
 - Afim de demosntrar o domínio na construção de tela e frontend,
 optei por usar as classes do Boottrap mas também desenvolver
 meu próprio CSS;
 
 - Como poderás ver no início dos commits usei o recurso do Laravel
 ***Blade Components** mas depois abandonei pois quis demonstrar minha
 expertise em fronent;

 - Afim de ajudar o avaliador, pus uma SEED para ser executada e 
 popular as tabelas;

 - Perceba que não removi o .env e isso foi proposital para facilitar
 mas reconheço que é má prática

## 🚀 Tecnologias utilizadas

- Laravel 11
- PHP 8.2
- PostgreSQL
- Docker
- Bootstrap
- jQuery / AJAX
- Node v24.13
- PHP v8.2
- Bootstrap v5

---

## ✅ Requisitos

- Docker Desktop instalado e em execução
- WSL (opcional, caso utilize Linux)

---

## ▶️ Como executar o projeto

Clone o repositório:
```bash
git clone https://github.com/WerbystonLemos/taskManagementLikeTrello
```
Acessar diretório clonado:
```bash
cd taskManagementLikeTrello
```

Construir os containers:
```bash
docker compose up -d --build
```

[🚨ATENÇÂO🚨] A seguit tens que rodar as migrations. 
Afim de facilitar, adicionei uma SEED para popular as tables:
```bash
docker exec -it laravel_app php artisan migrate --seed
```

Acessar diretório que contém o projeto:
```bash
cd /laravel
```

Executar o Vite dentro do container:
```bash
docker exec -it laravel_app npm run dev
```

