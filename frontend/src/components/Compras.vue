<template>
  <div class="container">
    <h2>Registrar Compra</h2>

    <form @submit.prevent="registrarCompra">
      <div class="campo-container">
        <label class="rotulo" for="fornecedor">Fornecedor</label>
        <input id="fornecedor" class="campo" v-model="compra.fornecedor" placeholder="Nome do fornecedor" required />
      </div>

      <div v-for="(item, idx) in compra.produtos" :key="idx" class="itens-produto">
        <div style="flex: 1">
          <label class="rotulo">Produto</label>
          <select v-model.number="item.id" class="campo">
            <option value="" disabled>Selecione um produto</option>
            <option v-for="p in produtos" :key="p.id" :value="p.id">{{ p.nome }}</option>
          </select>
        </div>

        <div style="width:120px">
          <label class="rotulo">Quantidade</label>
          <input class="campo" v-model.number="item.quantidade" type="number" min="1" required />
        </div>

        <div style="width:160px">
          <label class="rotulo">Preço unitário</label>
          <input class="campo" v-model.number="item.preco_unitario" type="number" step="0.01" min="0.01" required />
        </div>

        <button type="button" class="botao botao-perigo" @click="removerItem(idx)">Remover</button>
      </div>

      <div style="display:flex; gap:10px; margin-top:10px">
        <button type="button" class="botao botao-primario" @click="adicionarItem">Adicionar Produto</button>
        <button type="submit" class="botao botao-sucesso">Registrar Compra</button>
      </div>
    </form>
  </div>
</template>

<script>
import api from '../api/api.js';
import { ref, onMounted } from 'vue';
import { useToast } from 'vue-toastification';

export default {
  setup() {
    const produtos = ref([]);
    const compra = ref({ fornecedor: '', produtos: [{ id: null, quantidade: 1, preco_unitario: 0 }] });
    const toast = useToast();

    const listar = async () => {
      try { produtos.value = (await api.get('/produtos')).data; }
      catch { toast.error('Erro ao carregar produtos'); }
    };

    const adicionarItem = () => compra.value.produtos.push({ id: null, quantidade: 1, preco_unitario: 0 });
    const removerItem = (i) => compra.value.produtos.splice(i, 1);

    const registrarCompra = async () => {
      try {
        await api.post('/compras', compra.value);
        toast.success('Compra registrada com sucesso!');
        compra.value = { fornecedor: '', produtos: [{ id: null, quantidade: 1, preco_unitario: 0 }] };
        listar();
      } catch (err) { toast.error(err.response?.data?.message || 'Erro ao registrar compra'); }
    };

    onMounted(listar);
    return { produtos, compra, adicionarItem, removerItem, registrarCompra };
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

.itens-produto {
  display: flex;
  gap: 12px;
  align-items: end;
  flex-wrap: wrap;
  margin-bottom: 10px;
}

.botao {
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
   margin: 0px 0px 14px ;
}

.botao-primario {
  background: var(--primaria);
  color: #fff;
}

.botao-primario:hover {
  opacity: 0.95;
}

.botao-sucesso {
  background: var(--sucesso);
  color: #fff;
}

.botao-sucesso:hover {
  opacity: 0.95;
}

.botao-perigo {
  background: var(--perigo);
  color: #fff;
}

.botao-perigo:hover {
  opacity: 0.95;
}
</style>
