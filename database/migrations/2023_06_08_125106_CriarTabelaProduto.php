<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->string('codigo');
            $table->string('descricao');
            $table->string('foto');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
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
        Schema::dropIfExists('produtos');
    }
}
