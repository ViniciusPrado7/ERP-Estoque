<template>
  <div class="container">
    <h2>Registrar Venda</h2>

    <form @submit.prevent="registrarVenda">
      <div style="margin-bottom:10px">
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
      try {
        const res = await api.get('/produtos');
        produtos.value = res.data;
      } catch {
        toast.error('Erro ao carregar produtos');
      }
    };

    const precoSugerido = (produtoId) => {
      const p = produtos.value.find(x => x.id === produtoId);
      return p ? Number(p.preco_venda).toFixed(2) : '0.00';
    };

    const adicionarItem = () => venda.value.produtos.push({ id: null, quantidade: 1 });
    const removerItem = (i) => {
      venda.value.produtos.splice(i, 1);
      recalcular();
    };

    const atualizarPreco = (idx) => {
      // apenas recalcula valores mostrados
      recalcular();
    };

    const totalEstimado = computed(() => {
      let t = 0;
      for (const item of venda.value.produtos) {
        const p = produtos.value.find(x => x.id === item.id);
        if (p) t += (Number(p.preco_venda) || 0) * (Number(item.quantidade) || 0);
      }
      return t;
    });

    const lucroEstimado = computed(() => {
      let l = 0;
      for (const item of venda.value.produtos) {
        const p = produtos.value.find(x => x.id === item.id);
        if (p) {
          const custo = Number(p.custo_medio) || 0;
          const preco = Number(p.preco_venda) || 0;
          l += (preco - custo) * (Number(item.quantidade) || 0);
        }
      }
      return l;
    });

    const numberFormat = (v) => Number(v || 0).toFixed(2);

    const recalcular = () => {
      // forçar atualização dos computeds (em Vue 3 eles atualizam automaticamente)
    };

    const registrarVenda = async () => {
      try {
        // Payload sem preco_unitario — backend usa preco_venda do produto
        const payload = {
          cliente: venda.value.cliente,
          produtos: venda.value.produtos.map(i => ({ id: i.id, quantidade: i.quantidade })),
        };
        const res = await api.post('/vendas', payload);
        toast.success('Venda registrada com sucesso!');
        venda.value = { cliente: '', produtos: [{ id: null, quantidade: 1 }] };
        listar();
      } catch (err) {
        toast.error(err.response?.data?.message || 'Erro ao registrar venda');
      }
    };

    onMounted(listar);

    return {
      produtos, venda, adicionarItem, removerItem, atualizarPreco,
      precoSugerido, totalEstimado, lucroEstimado, numberFormat, registrarVenda, recalcular
    };
  },
};
</script>
