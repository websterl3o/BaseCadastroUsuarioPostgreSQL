# BaseCadastroUsuarioPostgreSQL

## Descrição do Projeto

Projeto BaseCadastroUsuarioPostgreSQL é uma aplicação web que permite o cadastro de usuários e login de usuários. O projeto foi desenvolvido utilizando o framework Laravel e banco de dados PostgreSQL. O projeto foi desenvolvido para atender o desafio proposto pela empresa [Firts decision](https://www.firstdecision.com.br/).

## Regras:
- Crie uma página de registro de usuário com os seguintes campos:
   - Nome (obrigatório, mínimo de 3 caracteres, máximo de 50 caracteres).
   - E-mail (obrigatório, deve ser um e-mail válido).
   - Senha (obrigatória, mínimo de 6 caracteres, máximo de 20 caracteres).
   - Confirmação de Senha (obrigatória e deve coincidir com a senha).
 - Crie uma API RESTful em Laravel para processar o registro de usuários.
   - Valide os dados recebidos da solicitação, incluindo a confirmação de senha.
   - Armazene os usuários registrados no banco de dados PostgreSQL.
   - Retorne uma resposta apropriada para o front-end (por exemplo, sucesso ou erro) no formato JSON.
 - Crie testes unitarios para a API RESTful.
   - Escreva pelo menos um teste unitário para a API Laravel para garantir que os dados sejam validados corretamente e armazenados no banco de dados PostgreSQL.
   - Utilize a ferramenta de teste do Laravel para isso.

## Tecnologias e Ferramentas Utilizadas

<div align="left">
    <img src="https://img.shields.io/badge/-Docker-%23fff?style=for-the-badge&logo=docker&logoColor=2496ED" target="_blank">
    <img src="https://img.shields.io/badge/-PHP-%23fff?style=for-the-badge&logo=php&logoColor=777BB4" target="_blank">
    <img src="https://img.shields.io/badge/-Laravel-%23fff?style=for-the-badge&logo=laravel&logoColor=FF2D20" target="_blank">
    <img src="https://img.shields.io/badge/-PHPUnit-%23fff?style=for-the-badge&logo=phpunit&logoColor=4FC08D" target="_blank">
    <img src="https://img.shields.io/badge/-PostgreSQL-%23fff?style=for-the-badge&logo=postgresql&logoColor=2496ED" target="_blank">
    <img src="https://img.shields.io/badge/-Vite-%23fff?style=for-the-badge&logo=vite&logoColor=4FC08D" target="_blank">
</div>

## Configuração do Ambiente Docker
1. Clone o repositório do projeto
```shellScript
git clone git@github.com:websterl3o/BaseCadastroUsuarioPostgreSQL.git
```
2. Crie o arquivo .env apartir do .env.example
```shellScript
cp .env.example .env
```
3. Execute o comando para subir o ambiente
```shellScript
docker-compose up -d --build
```
4. Execute o comando para instalar as dependências do projeto
```shellScript
docker-compose exec app composer install
```
5. Execute o comando para gerar a chave do projeto
```shellScript
docker-compose exec app php artisan key:generate
```
6. Execute o comando para criar a estrutura do banco de dados
```shellScript
docker-compose exec app php artisan migrate
```
7. Instalar dependencias do node
```shellScript
docker-compose exec app npm install
```
10. Execute o comando para subir o servidor de desenvolvimento
```shellScript
docker-compose exec app npm run dev
```
11. Acesse o projeto em http://localhost:9898

### Rotas da Aplicação

| Método | URI        | Descrição                       |
| ------ | ---------- | ------------------------------- |
| GET    | /register  | Página de registro de usuário.  |
| GET    | /login     | Página de login de usuário.     |
| GET    | /dashboard | Página de dashboard de usuário. |
| GET    | /logout    | Logout de usuário.              |

### Rotas da API

| Método | URI                                | Descrição                            | Body                                                                                                         |
| ------ | ---------------------------------- | ------------------------------------ | ------------------------------------------------------------------------------------------------------------ |
| POST   | http://localhost:9898/api/register | Registra um novo usuário.            | ``` { "name": "Leo", "email": "leo@gmail.com", "password": "dasdas", "password_confirmation": "dasdas" } ``` |
| POST   | http://localhost:9898/api/login    | Login em um usuário.                 | ``` { "email": "leo@gmail.com", "password": "dasdaas" } ```                                                  |
| GET    | http://localhost:9898/api/me       | Busca informações do usuário logado. |                                                                                                              |
| POST   | http://localhost:9898/api/logout   | Remove sessão de usuário logado.     |                                                                                                              |