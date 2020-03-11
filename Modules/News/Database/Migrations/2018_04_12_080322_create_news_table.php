<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::create('news', function (Blueprint $table) {
				$table->increments('id');
				$table->string('image')->nullable();
				$table->boolean('actif')->default(false);
				$table->integer('user_id')->unsigned();
				$table->foreign('user_id')
					  ->references('id')
					  ->on('users')
					  ->onDelete('cascade');
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
			Schema::table('news', function(Blueprint $table) {
				$table->dropForeign('news_user_id_foreign');
			});
			Schema::dropIfExists('news');
    }
}
