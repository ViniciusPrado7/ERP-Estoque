<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
       Schema::create('compras', function (Blueprint $table) {
    $table->id();
    $table->string('fornecedor');
    $table->decimal('total', 14, 2)->default(0);

});

    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
