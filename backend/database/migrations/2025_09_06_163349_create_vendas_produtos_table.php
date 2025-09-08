<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('venda_produto', function (Blueprint $table) {
    $table->id();
    $table->foreignId('venda_id')->constrained('vendas')->onDelete('cascade');
    $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
    $table->integer('quantidade');
    $table->decimal('preco_unitario', 12, 2);
    $table->decimal('custo_unitario', 12, 2);

});

    }

    public function down()
    {
        Schema::dropIfExists('vendas_produto');
    }
}
