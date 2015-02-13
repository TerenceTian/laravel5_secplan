<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name')->unique();
			$table->string('intro');
			$table->string('logo_url')->nullable();
			$table->string('pic_url')->nullable();
			$table->integer('view_count')->default(0);
			$table->integer('favourite_count')->default(0);
			$table->integer('status')->default(0);
			$table->integer('total_sale')->default(0);
			$table->timestamps();

			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shops');
	}

}
