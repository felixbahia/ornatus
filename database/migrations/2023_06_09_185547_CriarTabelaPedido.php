<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->integer('cliente_id')->unsigned();
            $table->float('valor_total_produtos');
            $table->float('frete');
            $table->float('valor_total');
            $table->integer('status_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_id')
                ->references('id')
                ->on('pedido_status')
                ->onDelete('NO ACTION');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('dados_clientes')
                ->onDelete('NO ACTION');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('NO ACTION');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('NO ACTION');
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users')
                ->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
