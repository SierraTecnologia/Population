<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBossPessoalEmpregoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salario')->nullable();
            $table->string('url')->nullable();
            $table->string('language_code_id')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();
        });
        Schema::create('vaga_candidatos', function (Blueprint $table) {

            // Set the storage engine and primary key
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Ordinary columns
            $table->string('name')->nullable();
            $table->string('salario')->nullable();
            $table->string('rh_people')->nullable();
            $table->integer('acept_by_organizer')->unsigned()->default(0);
            $table->string('date')->nullable();
            $table->string('obs')->nullable();
            $table->string('vaga_id')->nullable();

            // Automatic columns
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
		Schema::dropIfExists('vagas_candidatos');
		Schema::dropIfExists('vagas');
    }
}
