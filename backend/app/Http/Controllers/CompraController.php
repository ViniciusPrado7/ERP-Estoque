<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use App\DTOs\CompraDTO;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    protected $compraService;

    public function __construct(CompraService $compraService)
    {
        $this->compraService = $compraService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'fornecedor' => 'required|string',
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|integer|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'produtos.*.preco_unitario' => 'required|numeric|min:0.01',
        ]);

        $compraDTO = new CompraDTO($request->all());

        return $this->compraService->criarCompra($compraDTO);
    }

    public function index()
    {
        $compras = \App\Models\Compra::with('produtos')->get();
        return $compras;
    }
}
