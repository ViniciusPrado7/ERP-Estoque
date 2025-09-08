<template>
  <div id="app">
    <h1>ERP de Estoque</h1>

    <div class="navegacao">
      <button
        class="botao botao-primario"
        :class="{ ativo: atual === 'produtos' }"
        @click="atual = 'produtos'">Produtos</button>

      <button
        class="botao botao-primario"
        :class="{ ativo: atual === 'compras' }"
        @click="atual = 'compras'">Compras</button>

      <button
        class="botao botao-primario"
        :class="{ ativo: atual === 'vendas' }"
        @click="atual = 'vendas'">Vendas</button>

      <button
        class="botao botao-primario"
        :class="{ ativo: atual === 'lista-compras' }"
        @click="atual = 'lista-compras'">Histórico Compras</button>

      <button
        class="botao botao-primario"
        :class="{ ativo: atual === 'lista-vendas' }"
        @click="atual = 'lista-vendas'">Histórico Vendas</button>
    </div>

    <Produtos v-if="atual === 'produtos'" />
    <Compras v-if="atual === 'compras'" />
    <Vendas v-if="atual === 'vendas'" />
    <ListaCompras v-if="atual === 'lista-compras'" />
    <ListaVendas v-if="atual === 'lista-vendas'" />
  </div>
</template>

<script>
import Produtos from './components/Produtos.vue';
import Compras from './components/Compras.vue';
import Vendas from './components/Vendas.vue';
import ListaCompras from './components/ListaCompras.vue';
import ListaVendas from './components/ListaVendas.vue';

export default {
  components: { Produtos, Compras, Vendas, ListaCompras, ListaVendas },
  data() {
    return { atual: 'produtos' };
  },
};
</script>
