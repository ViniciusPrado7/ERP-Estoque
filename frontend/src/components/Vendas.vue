<template>
  <div class="container">
    <h2>Registrar Venda</h2>

    <form @submit.prevent="registrarVenda">
      <div class="campo-container">
        <label class="rotulo" for="cliente">Cliente</label>
        <input id="cliente" class="campo" v-model="venda.cliente" placeholder="Nome do cliente" required />
      </div>

      <div v-for="(item, idx) in venda.produtos" :key="idx" class="itens-produto">
        <div style="flex:1">
          <label class="rotulo">Produto</label>
          <select v-model.number="item.id" class="campo" @change="atualizarPreco(idx)">
            <option value="" disabled>Selecione um produto</option>
            <option v-for="p in produtos" :key="p.id" :value="p.id">
              {{ p.nome }} (Estoque: {{ p.estoque ?? 0 }})
            </option>
          </select>
        </div>

        <div style="width:120px">
          <label class="rotulo">Quantidade</label>
          <input class="campo" type="number" v-model.number="item.quantidade" min="1" required @input="recalcular()" />
        </div>

        <div style="width:160px">
          <label class="rotulo">Preço unitário (sugerido)</label>
          <input class="campo" :value="precoSugerido(item.id)" readonly />
        </div>

        <button type="button" class="botao botao-perigo" @click="removerItem(idx)">Remover</button>
      </div>

      <div style="display:flex; gap:10px; margin-top:10px">
        <button type="button" class="botao botao-primario" @click="adicionarItem">Adicionar Produto</button>
        <button type="submit" class="botao botao-sucesso">Registrar Venda</button>
      </div>
    </form>

    <div class="resultado" v-if="venda.produtos.length">
      <h3>Resumo (estimado)</h3>
      <p>Total estimado: R$ {{ numberFormat(totalEstimado) }}</p>
      <p>Lucro estimado: R$ {{ numberFormat(lucroEstimado) }}</p>
    </div>
  </div>
</template>

<script>
import api from '../api/api.js';
import { ref, onMounted, computed } from 'vue';
import { useToast } from 'vue-toastification';

export default {
  setup() {
    const produtos = ref([]);
    const venda = ref({ cliente: '', produtos: [{ id: null, quantidade: 1 }] });
    const toast = useToast();

    const listar = async () => {
      try { produtos.value = (await api.get('/produtos')).data; }
      catch { toast.error('Erro ao carregar produtos'); }
    };

    const precoSugerido = (produtoId) => {
      const p = produtos.value.find(x => x.id === produtoId);
      return p ? Number(p.preco_venda).toFixed(2) : '0.00';
    };

    const adicionarItem = () => venda.value.produtos.push({ id: null, quantidade: 1 });
    const removerItem = (i) => { venda.value.produtos.splice(i, 1); recalcular(); };
    const atualizarPreco = (idx) => recalcular();

    const totalEstimado = computed(() => {
      return venda.value.produtos.reduce((t, item) => {
        const p = produtos.value.find(x => x.id === item.id);
        return p ? t + p.preco_venda * item.quantidade : t;
      }, 0);
    });

    const lucroEstimado = computed(() => {
      return venda.value.produtos.reduce((l, item) => {
        const p = produtos.value.find(x => x.id === item.id);
        return p ? l + (p.preco_venda - p.custo_medio) * item.quantidade : l;
      }, 0);
    });

    const numberFormat = v => Number(v || 0).toFixed(2);
    const recalcular = () => { };

    const registrarVenda = async () => {
      try {
        await api.post('/vendas', { cliente: venda.value.cliente, produtos: venda.value.produtos.map(i => ({ id: i.id, quantidade: i.quantidade })) });
        toast.success('Venda registrada com sucesso!');
        venda.value = { cliente: '', produtos: [{ id: null, quantidade: 1 }] };
        listar();
      } catch (err) { toast.error(err.response?.data?.message || 'Erro ao registrar venda'); }
    };

    onMounted(listar);
    return { produtos, venda, adicionarItem, removerItem, atualizarPreco, precoSugerido, totalEstimado, lucroEstimado, numberFormat, registrarVenda, recalcular };
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

.resultado {
  margin-top: 14px;
  padding: 12px;
  border-radius: 8px;
  background: #f2fff3;
  border: 1px solid #c9efce;
}
</style>
