<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('compra_produto', function (Blueprint $table) {
    $table->id();
    $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade');
    $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
    $table->integer('quantidade');
    $table->decimal('preco_unitario', 12, 2);

});

    }

    public function down()
    {
        Schema::dropIfExists('compra_produto');
    }
}
