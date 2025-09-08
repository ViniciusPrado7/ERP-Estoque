<template>
  <div class="container">
    <h2>Produtos</h2>

    <form @submit.prevent="cadastrarProduto" class="form-inline">
      <div class="campo-container">
        <label class="rotulo" for="nome">Nome do produto</label>
        <input id="nome" class="campo" v-model="novo.nome" placeholder="Ex: Camisa Polo" required />
      </div>

      <div class="campo-container">
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
      try { produtos.value = (await api.get('/produtos')).data; }
      catch { toast.error('Erro ao carregar produtos'); }
    };

    const cadastrarProduto = async () => {
      try {
        await api.post('/produtos', novo.value);
        toast.success('Produto cadastrado com sucesso!');
        novo.value = { nome: '', preco_venda: 0 };
        listar();
      } catch (err) { toast.error(err.response?.data?.message || 'Erro ao cadastrar produto'); }
    };

    const numberFormat = v => Number(v || 0).toFixed(2);
    onMounted(listar);

    return { produtos, novo, cadastrarProduto, numberFormat };
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

h2 { margin-bottom: 14px; }

.rotulo {
  display: block;
  font-weight: 600;
  margin-bottom: 6px;
  font-size: 14px;
}

.campo {
  width: 100%;
  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid var(--borda-input);
  background: var(--fundo-input);
  font-size: 14px;
  margin-bottom: 10px;
}

.form-inline {
  display: flex;
  gap: 12px;
  align-items: end;
  margin-bottom: 12px;
}

.tabela {
  width: 100%;
  border-collapse: collapse;
  margin-top: 12px;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
}
.tabela thead { background: #f6f8fb; }
.tabela th, .tabela td {
  padding: 10px 12px;
  border-bottom: 1px solid #eef0f4;
  text-align: left;
  font-size: 14px;
}

.botao {
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  margin: 0px 0px 14px ;
}

.botao-sucesso {
  background: var(--sucesso);
  color: #fff;
}
</style>
