ERP Estoque

Sistema de gestão de estoque desenvolvido com Vue.js no frontend e Laravel (PHP) no backend, permitindo o controle de produtos, compras e vendas de forma prática.

🚀 Tecnologias Utilizadas

Frontend: Vue.js, Vue Router, Axios, Vue Toastification

Backend: Laravel (PHP), MySQL

Estilização: CSS modular com variáveis

Gerenciamento de Rotas: Vue Router

📦 Estrutura do Projeto
Frontend (frontend/)

components/: Componentes Vue para produtos, compras, vendas e históricos

router/: Configuração das rotas da aplicação

api/: Arquivo de integração com backend via Axios

Backend (backend/)

app/Http/Controllers/: Controllers do sistema

database/migrations/: Migrations para criar tabelas

routes/api.php: Rotas da API

⚙️ Funcionalidades
Produtos

Cadastrar novos produtos com preço de venda e custo médio

Listar produtos e estoque atual

Compras

Registrar compras com fornecedor e produtos

Visualizar histórico de compras

Vendas

Registrar vendas com cliente e produtos

Visualizar histórico de vendas

Cálculo de total e lucro estimado

Estoque

Controle automático de estoque com base em compras e vendas

📥 Como Rodar o Projeto
Backend (Laravel + MySQL)

Instale as dependências via Composer:

composer install


Configure o arquivo .env com as credenciais do banco de dados.

Execute as migrations para criar as tabelas:

php artisan migrate


Inicie o servidor de desenvolvimento Laravel:

php artisan serve

Frontend (Vue.js)

Navegue até a pasta frontend/.

Instale as dependências:

npm install


Inicie o servidor de desenvolvimento:

npm run dev


Acesse http://localhost:8080 no navegador.

🧪 Testes

Testes podem ser realizados diretamente via frontend com cadastro e listagem de produtos, compras e vendas.

Logs e erros aparecem no console ou via notificação usando Vue Toastification.
