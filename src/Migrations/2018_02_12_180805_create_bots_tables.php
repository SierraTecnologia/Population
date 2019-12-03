<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateBotsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_runners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action_code')->nullable();
            $table->string('target_id')->nullable();
            $table->string('progress')->nullable();
            $table->string('stage')->nullable();
            $table->timestamps();
        });
        Schema::create('bot_internet_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->string('type')->nullable(); //get ou post 
            $table->string('response_format')->nullable(); //html ou json, ou xml 
            $table->string('title')->nullable();
            $table->string('crawled')->nullable();
            $table->string('crawl_tag')->nullable();
            $table->string('clicks')->nullable();
            $table->string('links')->nullable();
            $table->integer('infra_domain_id')->nullable();
            $table->integer('bot_internet_url_form_id')->nullable();
            $table->timestamps();
        });
        Schema::create('bot_internet_url_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_bot_internet_url_id')->nullable();
            $table->integer('to_bot_internet_url_id')->nullable();
            $table->timestamps();
        });
        Schema::create('bot_internet_url_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identify')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->integer('from_bot_internet_url_id')->nullable(); // SIte aonde o formulario esta sendo preencido
            $table->integer('to_bot_internet_url_id')->nullable(); // Site para onde o formulario esta indo
            $table->timestamps();
        });
        Schema::create('bot_internet_url_form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('bot_internet_url_form_id')->nullable();
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
        Schema::dropIfExists('bots');
    }
}
