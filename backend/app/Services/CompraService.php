<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\Produto;
use App\DTOs\CompraDTO;
use Illuminate\Support\Facades\DB;

class CompraService
{
    public function criarCompra(CompraDTO $compraDTO)
    {
        return DB::transaction(function () use ($compraDTO) {
            $compra = Compra::create([
                'fornecedor' => $compraDTO->fornecedor,
                'total' => 0,
            ]);

            $total = 0;

            foreach ($compraDTO->produtos as $p) {
                $produto = Produto::findOrFail($p['id']);
                $quantidade = $p['quantidade'];
                $precoUnit = $p['preco_unitario'];

                $novoEstoque = $produto->estoque + $quantidade;
                $novoCusto = ($produto->custo_medio * $produto->estoque + $precoUnit * $quantidade) / $novoEstoque;

                $produto->update([
                    'estoque' => $novoEstoque,
                    'custo_medio' => $novoCusto,
                ]);

                $compra->produtos()->attach($produto->id, [
                    'quantidade' => $quantidade,
                    'preco_unitario' => $precoUnit,
                ]);

                $total += $quantidade * $precoUnit;
            }

            $compra->update(['total' => $total]);

            return $compra->load('produtos');
        });
    }
}
