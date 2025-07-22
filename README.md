# Mini ERP Laravel

Este é um projeto de um mini ERP desenvolvido em Laravel, que gerencia pedidos, produtos, cupons e estoque. A aplicação utiliza um banco de dados MySQL para armazenar as informações e possui uma interface simples construída com Bootstrap.

## Estrutura do Projeto

- **app/**: Contém a lógica da aplicação, incluindo controladores e modelos.
  - **Http/Controllers/**: Controladores que gerenciam as operações de cupons, pedidos, produtos e estoque.
  - **Models/**: Modelos que representam as tabelas no banco de dados.
  
- **database/**: Contém as migrações e seeders para o banco de dados.
  - **migrations/**: Arquivos de migração para criar as tabelas de produtos, pedidos, cupons e estoques.
  
- **public/**: Contém os arquivos públicos da aplicação, incluindo o ponto de entrada `index.php` e arquivos CSS.
  
- **resources/**: Contém as views da aplicação, organizadas por funcionalidade.
  - **views/**: Views para gerenciar cupons, pedidos, produtos e estoques.
  - **layouts/**: Layout principal utilizado por todas as views.
  
- **routes/**: Contém as definições de rotas da aplicação.

## Instalação

1. Clone o repositório:
   ```
   git clone <URL_DO_REPOSITORIO>
   cd mini-erp-laravel
   ```

2. Instale as dependências do Composer:
   ```
   composer install
   ```

3. Configure o arquivo `.env` com as credenciais do banco de dados.

4. Execute as migrações:
   ```
   php artisan migrate
   ```

5. Inicie o servidor de desenvolvimento:
   ```
   php artisan serve
   ```

## Funcionalidades

- **Gerenciamento de Cupons**: Criação, atualização e listagem de cupons.
- **Gerenciamento de Pedidos**: Criação, atualização e listagem de pedidos, com cálculo de frete.
- **Gerenciamento de Produtos**: Criação, atualização e listagem de produtos, incluindo variações e estoques.
- **Gerenciamento de Estoque**: Atualização e listagem dos níveis de estoque dos produtos.

## Tecnologias Utilizadas

- PHP
- Laravel
- MySQL
- Bootstrap

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.