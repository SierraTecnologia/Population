<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesProductionsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Personagens
         */
        Schema::create(
            'personagens', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255)->nullable();
                $table->string('description')->nullable();
                $table->unsignedInteger('status')->default(0);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'personagenables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('personagenable_id')->nullable();
                $table->string('personagenable_type', 255)->nullable();

                $table->string('personagem_code')->nullable();
                $table->foreign('personagem_code')->references('code')->on('personagens');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        
        /**
         * Producoes
         */
        Schema::create(
            'productions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->integer('ano')->nullable();
                $table->integer('girls')->nullable();
                $table->integer('boys')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'productionables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('production_id')->nullable();
                $table->string('productionable_id')->nullable();
                $table->string('productionable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );



        /**
         * Resto
         */
        Schema::create(
            'production_variables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_actions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_action_ocorrences', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_action_types', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_actors', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_characters', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_character_clothings', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_clothings', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_clothing_types', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_items', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_rpg', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_scenes', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_scene_lines', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_scene_locals', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'production_scene_stages', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                // $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
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
        Schema::dropIfExists('production_variables');
    }

}
