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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');   //id do usuario
            $table->string('endereco', 200);
            $table->string('bairro', 100);
            $table->string('cep', 10);
            $table->string('cidade', 50);
            $table->string('telefone', 20);
            $table->string('cns', 20);
            $table->string('cbo', 6);
            $table->string('comentario', 250);
            $table->date('data_nascimento');
            $table->decimal('salario', 10, 2);
            $table->date('admission_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
