<template>
  <div class="container">
    <h2>Histórico de Compras</h2>

    <table class="tabela">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fornecedor</th>
          <th>Total</th>
          <th>Produtos</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="c in compras" :key="c.id">
          <td>{{ c.id }}</td>
          <td>{{ c.fornecedor }}</td>
          <td>{{ numberFormat(c.total) }}</td>
          <td>
            <ul>
              <li v-for="p in c.produtos" :key="p.id">
                {{ p.nome }} — qt: {{ p.pivot.quantidade }} — preco unit: R$ {{ numberFormat(p.pivot.preco_unitario) }}
              </li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '../api/api.js';
import { ref, onMounted } from 'vue';
import { useToast } from 'vue-toastification';

export default {
  setup() {
    const compras = ref([]);
    const toast = useToast();

    const listar = async () => {
      try {
        const res = await api.get('/compras');
        compras.value = res.data;
      } catch {
        toast.error('Erro ao carregar histórico de compras');
      }
    };

    const numberFormat = (v) => Number(v || 0).toFixed(2);

    onMounted(listar);
    return { compras, numberFormat };
  }
};
</script>
