<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create(
            'emails', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('email')->unique();
                $table->primary('email');
                $table->string('address', 255)->nullable();
                $table->string('domain')->nullable();
                $table->integer('integration_id')->nullable();
                $table->unique(['address', 'domain', 'integration_id']);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'emailables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('emailable_id');
                $table->string('emailable_type', 255);
                $table->string('email_email');
                $table->foreign('email_email')->references('email')->on('emails');
            
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'phones', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('country', 255)->default('55')->nullable();
                $table->string('state', 255)->default('21')->nullable();
                $table->string('number')->nullable();
                $table->integer('whatsapp')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'phoneables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('phone_id')->unsigned();
                $table->string('phoneable_id');
                $table->string('phoneable_type', 255);
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



        Schema::dropIfExists('phoneables');
        Schema::dropIfExists('phones');
        Schema::dropIfExists('emailables');
        Schema::dropIfExists('emails');
    }

}
