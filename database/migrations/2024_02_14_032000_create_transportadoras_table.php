<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportadorasTable extends Migration
{
    public function up()
    {
        Schema::create('transportadoras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('endereco');
            $table->string('cidade');
            $table->string('uf');
            $table->integer('limite_credito');
            $table->date('data_analise_credito');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transportadoras');
    }
}
