<template>
  <div class="container">
    <h1>ERP de Estoque</h1>
    <nav>
      <button class="btn" @click="telaAtual = 'produtos'">Produtos</button>
      <button class="btn" @click="telaAtual = 'compras'">Compras</button>
      <button class="btn" @click="telaAtual = 'vendas'">Vendas</button>
    </nav>

    <Produtos v-if="telaAtual === 'produtos'" />
    <Compras v-if="telaAtual === 'compras'" />
    <Vendas v-if="telaAtual === 'vendas'" />
  </div>
</template>

<script>
import Produtos from '../components/Produtos.vue'
import Compras from '../components/Compras.vue'
import Vendas from '../components/Vendas.vue'

export default {
  components: { Produtos, Compras, Vendas },
  data() {
    return { telaAtual: 'produtos' }
  },
}
</script>
