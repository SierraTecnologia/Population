<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOrganizationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Businesses
         */
        Schema::create(
            'businesses', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
            
                $table->string('name', 255);
                $table->string('description')->nullable();

                $table->string('layoult')->nullable();

                $table->string('dominio')->nullable();
                $table->string('subdominio')->nullable();

                $table->string('type')->nullable();
                $table->integer('status')->nullable();
            
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'businessables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('businessable_id');
                $table->string('businessable_type', 255);
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'business_sectors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('slug')->nullable();
                $table->integer('status')->default(1);
                $table->integer('business_sector_id')->unsigned()->nullable();

                $table->timestamps();
            }
        );

        Schema::create(
            'business_products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('status')->default(1);
                $table->string('business_code')->nullable();
                $table->string('user_code')->nullable();
                $table->timestamps();
            }
        );

        // @todo Resolver isso aqui
        Schema::create(
            'business_collaborators', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('cpf')->nullable();
                $table->integer('status')->default(1);
                $table->string('business_code')->nullable();
                $table->string('user_code')->nullable();
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
        Schema::dropIfExists('business_products');
        Schema::dropIfExists('business_collaborators');
        Schema::dropIfExists('business_sectors');
        Schema::dropIfExists('organizations');
    }
}
