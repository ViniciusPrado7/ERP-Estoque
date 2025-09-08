<template>
  <div class="container">
    <h2>Produtos</h2>

    <form @submit.prevent="cadastrarProduto" class="form-inline" style="display:flex; gap:12px; align-items:end; margin-bottom:12px;">
      <div style="flex:1">
        <label class="rotulo" for="nome">Nome do produto</label>
        <input id="nome" class="campo" v-model="novo.nome" placeholder="Ex: Camisa Polo" required />
      </div>

      <div style="width:180px">
        <label class="rotulo" for="preco">Preço de venda (sugestão)</label>
        <input id="preco" class="campo" v-model.number="novo.preco_venda" type="number" step="0.01" min="0" placeholder="Ex: 99.90" required />
      </div>

      <button type="submit" class="botao botao-sucesso">Cadastrar</button>
    </form>

    <table class="tabela">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Custo Médio</th>
          <th>Preço de Venda</th>
          <th>Estoque</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in produtos" :key="p.id">
          <td>{{ p.nome }}</td>
          <td>{{ numberFormat(p.custo_medio) }}</td>
          <td>{{ numberFormat(p.preco_venda) }}</td>
          <td>{{ p.estoque ?? 0 }}</td>
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
    const produtos = ref([]);
    const novo = ref({ nome: '', preco_venda: 0 });
    const toast = useToast();

    const listar = async () => {
      try {
        const res = await api.get('/produtos');
        produtos.value = res.data;
      } catch (e) {
        toast.error('Erro ao carregar produtos');
      }
    };

    const cadastrarProduto = async () => {
      try {
        await api.post('/produtos', novo.value);
        toast.success('Produto cadastrado com sucesso!');
        novo.value = { nome: '', preco_venda: 0 };
        listar();
      } catch (err) {
        toast.error(err.response?.data?.message || 'Erro ao cadastrar produto');
      }
    };

    const numberFormat = (v) => Number(v || 0).toFixed(2);

    onMounted(listar);
    return { produtos, novo, cadastrarProduto, numberFormat };
  },
};
</script>
