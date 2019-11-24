<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integration_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::create('integration_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('token');
            $table->integer('integration_service_id');
            $table->integer('status')->default(1);
            $table->string('obs')->nullable();
            $table->json('scopes')->nullable();
            $table->timestamps();
        });
        Schema::create('integration_token_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model')->nullable();
            $table->string('model_id')->nullable();
            $table->string('token_id')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('integration_services');
    }
}
