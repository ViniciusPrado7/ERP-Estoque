<template>
  <div id="app">
    <h1>ERP de Estoque</h1>

    <div class="navegacao">
      <router-link to="/" class="botao botao-primario">Produtos</router-link>
      <router-link to="/compras" class="botao botao-primario">Compras</router-link>
      <router-link to="/vendas" class="botao botao-primario">Vendas</router-link>
      <router-link to="/historico-compras" class="botao botao-primario">Histórico Compras</router-link>
      <router-link to="/historico-vendas" class="botao botao-primario">Histórico Vendas</router-link>
    </div>

    <router-view />
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style scoped>
:root {
  --primaria: #007bff;
  --sucesso: #28a745;
  --perigo: #dc3545;
  --fundo-input: #f7f8fa;
  --borda-input: #dcdfe6;
  --card: #ffffff;
  --texto: #213547;
  --sombral: 0 6px 18px rgba(33,53,71,0.08);
  --raio: 10px;
  font-family: Inter, system-ui, Avenir, Helvetica, Arial, sans-serif;
}

#app {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  min-height: 100vh;
  background: #f4f6fb;
  color: var(--texto);
  padding: 2rem;
}

h1 {
  text-align: center;
  margin-bottom: 16px;
  font-size: 28px;
}

.navegacao {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin-bottom: 18px;
}

.navegacao .botao {
  padding: 8px 16px;
}

.botao {
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
}
.botao-primario { background: var(--primaria); color: #fff; }
.botao-primario:hover { opacity: 0.95; }
.botao-sucesso { background: var(--sucesso); color: #fff; }
.botao-sucesso:hover { opacity: 0.95; }
.botao-perigo { background: var(--perigo); color: #fff; }
.botao-perigo:hover { opacity: 0.95; }
</style>
