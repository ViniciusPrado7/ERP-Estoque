<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco_venda',
        'custo_medio',
        'estoque',
    ];

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_produto')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'venda_produto')
                    ->withPivot('quantidade', 'preco_unitario', 'custo_unitario')
                    ->withTimestamps();
    }
}
