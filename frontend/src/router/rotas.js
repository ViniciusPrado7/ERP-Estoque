import { createRouter, createWebHistory } from 'vue-router';

import Produtos from '../components/Produtos.vue';
import Compras from '../components/Compras.vue';
import Vendas from '../components/Vendas.vue';
import ListaCompras from '../components/ListaCompras.vue';
import ListaVendas from '../components/ListaVendas.vue';

const routes = [
  { path: '/', name: 'Produtos', component: Produtos },
  { path: '/compras', name: 'Compras', component: Compras },
  { path: '/vendas', name: 'Vendas', component: Vendas },
  { path: '/historico-compras', name: 'ListaCompras', component: ListaCompras },
  { path: '/historico-vendas', name: 'ListaVendas', component: ListaVendas },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
