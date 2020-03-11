<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menuitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('menu_items', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('display_name');
			$table->integer('menu_id')->unsigned();
			$table->foreign('menu_id')
				->references('id')
				->on('menus')
				->onDelete('cascade');
			$table->integer('left')->unsigned();
			$table->integer('right')->unsigned();
			$table->integer('level')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('arbre_id')->unsigned()->nullable();
			$table->boolean('hidden')->default(false);
			$table->boolean('readonly')->default(false);
			$table->string('url')->nullable();
			$table->string('target')->default("_self");
			$table->boolean('actif')->default(false);
			$table->timestamps();
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('menu_items');
	}
}
