<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all(['id', 'nome', 'custo_medio', 'preco_venda', 'estoque']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'preco_venda' => 'required|numeric|min:0.01',
        ]);

        return Produto::create($request->all());
    }
}
