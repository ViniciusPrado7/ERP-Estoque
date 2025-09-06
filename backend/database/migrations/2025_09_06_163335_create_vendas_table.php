<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
    Schema::create('vendas', function (Blueprint $table) {
    $table->id();
    $table->string('cliente');
    $table->decimal('total', 14, 2)->default(0);
    $table->decimal('lucro', 14, 2)->default(0);
    $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELLED'])->default('COMPLETED');
    $table->timestamps();
});


    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
