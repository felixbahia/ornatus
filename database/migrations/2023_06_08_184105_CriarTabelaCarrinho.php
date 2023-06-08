<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCarrinho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade');
            $table->boolean('finalizado')->default(false);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('produto_id')
                ->references('id')
                ->on('produtos')
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
        Schema::dropIfExists('carrinhos');
    }
}
