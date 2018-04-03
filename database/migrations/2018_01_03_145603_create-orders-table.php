<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unique();
			$table->integer('user_id');
            $table->string('reference');
            $table->string('rastreio');
            $table->string('pagseguro_transaction_code');
            $table->string('qtde');
            $table->float('frete', 8,2);
            $table->float('preco_livro', 8,2);
            $table->float('taxa_pagseguro', 8,2);
            $table->float('preco_total', 8,2);
            $table->integer('status');
            $table->integer('status_envio');
            $table->string('forma_pagto');
            $table->string('url_boleto');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('orders');
    }
}
