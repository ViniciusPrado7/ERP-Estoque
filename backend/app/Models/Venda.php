<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'total',
        'lucro',
        'status',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'venda_produto')
                    ->withPivot('quantidade', 'preco_unitario', 'custo_unitario')
                    ->withTimestamps();
    }
}
