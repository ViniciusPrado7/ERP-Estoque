# ERP Estoque

Sistema de gestão de estoque desenvolvido com **Vue.js** no frontend e **PHP** no backend, permitindo o controle de produtos, compras e vendas de forma prática.

## 🚀 Tecnologias Utilizadas

- **Frontend:** Vue.js, Vue Router, Axios, Vue Toastification  
- **Backend:** PHP, MySQL  
- **Estilização:** CSS modular com variáveis  
- **Gerenciamento de Rotas:** Vue Router  

## 📦 Estrutura do Projeto

- `frontend/`: Código do frontend em Vue.js  
  - `components/`: Componentes Vue para produtos, compras, vendas e históricos  
  - `router/`: Configuração das rotas da aplicação  
  - `api/`: Arquivo de integração com backend via Axios  
- `backend/`: Código do backend em PHP  
  - Controllers, Models e rotas para manipulação do banco de dados  

## ⚙️ Funcionalidades

- **Produtos**
  - Cadastrar novos produtos com preço de venda e custo médio  
  - Listar produtos e estoque atual  
- **Compras**
  - Registrar compras com fornecedor e produtos  
  - Visualizar histórico de compras  
- **Vendas**
  - Registrar vendas com cliente e produtos  
  - Visualizar histórico de vendas  
  - Cálculo de total e lucro estimado  
- **Estoque**
  - Controle automático de estoque com base em compras e vendas  

## 📥 Como Rodar o Projeto

### Backend (PHP + MySQL)

1. Configure o banco de dados e crie as tabelas necessárias.  
2. Atualize as credenciais do banco no arquivo de configuração do backend.  
3. Execute o servidor PHP:  
   ```bash
   php -S localhost:8000 -t public
Frontend (Vue.js)
Navegue até a pasta frontend/.

Instale as dependências:

bash
Copiar código
npm install
Inicie o servidor de desenvolvimento:

bash
Copiar código
npm run serve
Acesse http://localhost:8080 no navegador.

🧪 Testes
Testes podem ser realizados diretamente via frontend com cadastro e listagem de produtos, compras e vendas.

Logs e erros aparecem no console ou via notificação usando Vue Toastification.
