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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');              //id do terapeuta
            $table->bigInteger('client_id');            //id do cliente
            $table->bigInteger('procediments_id');      //id do procedimento
            $table->string('title', 100)->nullable();               //titulo do atendimento
            $table->dateTime('start')->nullable();                 //data e hora de agendamento do atendimento
            $table->dateTime('end')->nullable();                   //data e hora de encerramento do atendimento
            $table->string('color', 50)->nullable();                //data de agendamento do atendimento
            $table->longText('descricao')->nullable();              //descreve o atendimento
            $table->string('status', 1)->nullable();
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
