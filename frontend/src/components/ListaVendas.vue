<template>
  <div class="container">
    <h2>Histórico de Vendas</h2>

    <table class="tabela">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Total</th>
          <th>Lucro</th>
          <th>Produtos</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="v in vendas" :key="v.id">
          <td>{{ v.id }}</td>
          <td>{{ v.cliente }}</td>
          <td>{{ numberFormat(v.total) }}</td>
          <td>{{ numberFormat(v.lucro) }}</td>
          <td>
            <ul>
              <li v-for="p in v.produtos" :key="p.id">
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
    const vendas = ref([]);
    const toast = useToast();

    const listar = async () => {
      try { vendas.value = (await api.get('/vendas')).data; }
      catch { toast.error('Erro ao carregar histórico de vendas'); }
    };

    const numberFormat = v => Number(v || 0).toFixed(2);
    onMounted(listar);
    return { vendas, numberFormat };
  }
};
</script>

<style scoped>
.container {
  background: var(--card);
  padding: 20px;
  border-radius: var(--raio);
  box-shadow: var(--sombral);
  margin-bottom: 20px;
}

h2 {
  margin-bottom: 14px;
}

.tabela {
  width: 100%;
  border-collapse: collapse;
  margin-top: 12px;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
}

.tabela thead {
  background: #f6f8fb;
}

.tabela th,
.tabela td {
  padding: 10px 12px;
  border-bottom: 1px solid #eef0f4;
  text-align: left;
  font-size: 14px;
}
</style>
