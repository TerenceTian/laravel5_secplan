<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('geo_id');
			$table->string('name');
			$table->integer('amount');
			$table->integer('original_price');
			$table->unsignedInteger('shop_id');
			$table->string('phone_number');
			$table->string('address');
			$table->integer('view_count')->default(0);
			$table->integer('like')->default(0);
			$table->integer('post_price')->default(0);
			$table->string('intro');
			$table->tinyInteger('visible')->default(0);
			$table->timestamps();

			$table->foreign('shop_id')
				->references('id')
				->on('shops')
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
		Schema::drop('items');
	}

}
