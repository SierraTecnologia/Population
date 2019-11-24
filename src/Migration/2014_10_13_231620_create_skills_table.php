<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		/**
		 * Skills
		 */
		Schema::create('skills', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->string('code')->unique();
            $table->primary('code');
			$table->string('name', 255)->nullable();
			$table->string('description', 255)->nullable();
			$table->integer('status')->nullable();
			$table->string('skill_code')->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
		Schema::create('skillables', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->string('valor', 255)->nullable();
			$table->string('skillable_id')->nullable();
			$table->string('skillable_type', 255)->nullable();
			$table->string('skill_code');
            $table->foreign('skill_code')->references('code')->on('skills');
			$table->timestamps();
            $table->softDeletes();
		});
		

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('taggables');
        Schema::drop('tags');
	}

}
