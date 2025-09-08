<?php

namespace App\Http\Controllers;

use App\Services\VendaService;
use App\DTOs\VendaDTO;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    protected $vendaService;

    public function __construct(VendaService $vendaService)
    {
        $this->vendaService = $vendaService;
    }


    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string',
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|integer|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        $vendaDTO = new VendaDTO($request->all());

        return $this->vendaService->criarVenda($vendaDTO);
    }

 
    public function index()
    {
        $vendas = \App\Models\Venda::with('produtos')->get();
        return $vendas;
    }
}
