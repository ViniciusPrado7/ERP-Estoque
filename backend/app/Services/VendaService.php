<?php

namespace App\Services;

use App\Models\Venda;
use App\Models\Produto;
use App\DTOs\VendaDTO;
use Illuminate\Support\Facades\DB;

class VendaService
{
    public function criarVenda(VendaDTO $vendaDTO)
    {
        return DB::transaction(function () use ($vendaDTO) {
            $venda = Venda::create([
                'cliente' => $vendaDTO->cliente,
                'total' => 0,
                'lucro' => 0,
                'status' => 'COMPLETED',
            ]);

            $total = 0;
            $lucro = 0;

            foreach ($vendaDTO->produtos as $p) {
                $produto = Produto::findOrFail($p['id']);
                $quantidade = $p['quantidade'];

                if ($produto->estoque < $quantidade) {
                    throw new \Exception("Estoque insuficiente para o produto: {$produto->nome}");
                }

               
                $precoUnit = $produto->preco_venda;

                $produto->update([
                    'estoque' => $produto->estoque - $quantidade,
                ]);

                $custoUnit = $produto->custo_medio;
                $subtotal = $quantidade * $precoUnit;
                $lucro += ($precoUnit - $custoUnit) * $quantidade;

                $venda->produtos()->attach($produto->id, [
                    'quantidade' => $quantidade,
                    'preco_unitario' => $precoUnit,
                    'custo_unitario' => $custoUnit,
                ]);

                $total += $subtotal;
            }

            $venda->update([
                'total' => $total,
                'lucro' => $lucro,
            ]);

            return $venda->load('produtos');
        });
    }
}
