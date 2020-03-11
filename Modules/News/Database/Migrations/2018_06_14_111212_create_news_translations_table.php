<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_translations', function (Blueprint $table) {
            //Les champs de la table
            $table->increments('id');
            $table->integer('news_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('resume');
            $table->longText('content');
            $table->string('image')->nullable();

            //
            $table->unique(['news_id','locale']);

            //Clés étrangers
            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');


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
        Schema::dropIfExists('news_translations');
    }
}
