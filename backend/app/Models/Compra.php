<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor',
        'total',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'compra_produto')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }
}
