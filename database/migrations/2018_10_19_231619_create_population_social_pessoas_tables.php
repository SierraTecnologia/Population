<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopulationSocialPessoasTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create(
            'sitios', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->string('url', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'sitioables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('sitio_id');
                $table->string('sitioable_id');
                $table->string('sitioable_type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        
        Schema::create(
            'infos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->longText('text', 255)->nullable();
                $table->string('infoable_id')->nullable();
                $table->string('infoable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        
        Schema::create(
            'tatuages', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->longText('text', 255)->nullable();
                $table->string('tatuageable_id');
                $table->string('tatuageable_type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'pircings', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->longText('text', 255)->nullable();
                $table->string('pircingable_id');
                $table->string('pircingable_type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'pintinhas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->longText('text', 255)->nullable();
                $table->string('pintinhable_id');
                $table->string('pintinhable_type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'itemables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('item_id')->unsigned();
                $table->string('itemable_id');
                $table->string('itemable_type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        

        
        
        // Ja tem essas tabelas no modulo home
        // Schema::create('links', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
        //     $table->integer('toable_id')->nullable();
        //     $table->string('toable_type', 255)->nullable();
        //     $table->integer('fromable_id')->nullable();
        //     $table->string('fromable_type', 255)->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        
        // Schema::create('urls', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
        //     $table->integer('server_id')->nullable();
        //     $table->string('url', 255)->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        
        
        Schema::create(
            'persons', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
                $table->string('cpf')->nullable();
                $table->string('birthday')->nullable();
                $table->string('facebook')->nullable();
                $table->integer('is_active')->nullable();
            
                $table->float('hr_clt')->nullable();
                $table->float('hr_paid')->nullable();
                $table->float('price_hour')->nullable(); // @todo VErificar se vai ficar aqui mesmo ou em outra tabela
                $table->float('price_monty')->nullable(); // @todo VErificar se vai ficar aqui mesmo ou em outra tabela
            
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'personables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('personable_id')->nullable();
                $table->string('personable_type', 255)->nullable();
                $table->string('person_code');
                $table->foreign('person_code')->references('code')->on('persons');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        // @todo Tirar aqui
        Schema::create(
            'identity_person_equipaments', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'identity_products', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'identity_hability_equipaments', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'identity_style_babys', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'identity_style_slaves', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );


        /**
         * Fatos e AContecimentos
         */
        Schema::create(
            'fatos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('date', 255)->nullable();
                $table->longText('text', 255)->nullable();
                $table->string('fatoable_id')->nullable();
                $table->string('fatoable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );


        /**
         * DELETAR
         */


        Schema::create(
            'identity_passwords', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->string('url')->nullable();
                $table->string('is_active')->nullable();
                $table->string('passwordable_id')->nullable();
                $table->string('passwordable_type')->nullable();
                $table->timestamps();
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



        Schema::dropIfExists('identity_passwords');
        Schema::dropIfExists('personables');
        Schema::dropIfExists('persons');
    }

}
