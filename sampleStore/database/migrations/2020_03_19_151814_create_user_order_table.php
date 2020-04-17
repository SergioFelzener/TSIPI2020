<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            //referencia do usuario para saber qual cliente que e dono do pedidio
            $table->unsignedBigInteger('user_id');
            // Loja exibe os pedidos da loja referencia com as lojas
            //$table->unsignedBigInteger('store_id');
            // referencia do pedido para futuramente mandar para o PagSeguro
            $table->string('reference');
            // salvo o cod da transacao no pagseguro
            $table->string('pagseguro_code');
            // salvar o status da transacao pelo pag seguro
            $table->integer('pagseguro_status');
            $table->text('itens');
            $table->timestamps();

            //chaves estrageiras

            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('store_id')->references('id')->on('stores');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
