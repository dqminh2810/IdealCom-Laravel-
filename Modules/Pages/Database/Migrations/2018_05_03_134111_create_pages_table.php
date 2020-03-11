<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->longText('code');
			$table->boolean('actif')->default(false);
			$table->timestamps();
			$table->engine = 'InnoDB';
		});
		// Permet de ne pas supprimer l'utilisateur si il a écrit des news
		// il faut supprimer avant les news ou changer l'auteur avant de le supprimer
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pages');
	}
}
