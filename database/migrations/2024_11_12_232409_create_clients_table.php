<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('cns', 20);
            $table->string('nome');
            $table->string('sexo', 15);
            $table->date('data_nascimento');
            $table->string('nacionalidade',15);
            $table->string('raca', 10)->nullable();
            $table->string('cor',15);
            $table->string('etnia',15)->nullable();
            $table->string('cep', 10);
            $table->string('logradouro', 10);
            $table->string('endereco', 200);
            $table->string('numero',6);
            $table->string('complemento',15)->nullable();
            $table->string('bairro', 100);
            $table->string('cidade', 50);
            $table->string('uf', 2);
            $table->string('telefone', 20);
            $table->string('email',50);
            $table->string('tipo_sangue');
            $table->string('ativ_laboral', 100)->nullable();
            $table->string('observacao', 250)->nullable();
            $table->date('last_atendimento');
            $table->dateTime('create_id', );
            $table->dateTime('update_id', );
            $table->string('ativo', 1);
            $table->softDeletes();         //controle de deletar registro softdelete
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
