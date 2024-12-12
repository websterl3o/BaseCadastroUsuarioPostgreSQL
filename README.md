# BaseCadastroUsuarioPostgreSQL

## Descrição do Projeto

Projeto PHP com Laravel para construção de um ambiente de cadastro de usuário usando com banco de dados PostgreSQL.

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