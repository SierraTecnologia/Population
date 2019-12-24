<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopulationCommerceTables extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        
		Schema::create(config('app.db-prefix', '').'propostas', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('name', 255)->nullable();
			$table->string('value', 255)->nullable();
			$table->string('parcelas', 255)->nullable();
			$table->string('money_id', 255)->nullable();
			$table->string('date', 255)->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
		Schema::create(config('app.db-prefix', '').'propostables', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->integer('proposta_id');
			$table->string('propostable_id');
			$table->string('propostable_type', 255);
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



		Schema::dropIfExists('propostables');
		Schema::dropIfExists('propostas');
	}

}
