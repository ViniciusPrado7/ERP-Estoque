<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco_venda', 12, 2);
            $table->decimal('custo_medio', 12, 2)->default(0);
            $table->integer('estoque')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
