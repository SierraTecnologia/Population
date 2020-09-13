<?php

use Population\Models\Entytys\Category\BibliotecaType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesBibliotecasTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'bibliotecas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->text('url')->nullable();
                $table->unsignedInteger('biblioteca_type_id')->nullable();
                $table->foreign('biblioteca_type_id')->references('id')->on('biblioteca_types')->onDelete('set null');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'bibliotecables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('bibliotecable_id');
                $table->string('bibliotecable_type', 255);

                $table->unsignedInteger('biblioteca_id')->nullable();
                // $table->foreign('biblioteca_id')->references('id')->on('bibliotecas');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acessorios');
        Schema::dropIfExists('equipaments');
        Schema::dropIfExists('vehicle_types');
    }

}
