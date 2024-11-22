<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# CMS API

API e banco de dados para a aplicação CMS (**Content Management System**), construída com Laravel e Docker. Este projeto inclui a aplicação principal e um banco de dados PostgreSQL.

## Pré-requisitos

Certifique-se de que você possui os seguintes softwares instalados em sua máquina:
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## Configuração do Ambiente

1. **Clone o repositório**  

   Clone este repositório em sua máquina local:
   
   ```bash
   git clone https://github.com/HitaloDev/CMS-API
   ```
   ```bash
   cd cms-api
   ```
   
2. **Configurar variáveis de ambiente**  

   Copie o conteúdo do arquivo .env.example, crie um novo arquivo chamado .env e cole o conteúdo copiado nele.


3. **Inicie os contêineres com Docker**

   No diretório raiz do projeto, execute:

   ```bash
   docker compose up -d
   ```
   Este comando iniciará:
    contêiner do Laravel.
    contêiner do banco de dados PostgreSQL.
    contêiner do Nginx.


4. **Acesse o terminal do contêiner Laravel**

   Para executar comandos dentro do contêiner Laravel:
   
   ```bash
   docker compose exec -it laravel bash
   ```

6. **Instale as dependências do Composer**

   Dentro do contêiner Laravel, instale as dependências do projeto:
   ```bash
   composer install
   ```
   
7. **Acesse a aplicação**
   Abra o navegador e acesse:
    ```bash
   http://localhost:8000
   ```
    
8. **Bônus**
   As rotas e seus modelos de requisição estão em
   ```bash
   http://localhost:8000/api/documentation#/Posts
   ```

**Estrutura do projeto**
    laravel-app: Contêiner onde a aplicação Laravel é executada.
    postgres: Contêiner do banco de dados PostgreSQL.
    nginx: Servidor HTTP que serve a aplicação Laravel.
