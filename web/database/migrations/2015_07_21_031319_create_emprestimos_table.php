<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('contato_id')->unsigned();
            $table->integer('tipo_emprestimo_id')->unsigned();
            $table->string('titulo', 150);
            $table->string('obs', 255)->nullable();
            $table->date('devolucao');
            $table->enum('status', ['aberto', 'devolvido', 'perdido']);
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('contato_id')->references('id')->on('contatos');
            $table->foreign('tipo_emprestimo_id')->references('id')->on('tipos_emprestimos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emprestimos');
    }
}
