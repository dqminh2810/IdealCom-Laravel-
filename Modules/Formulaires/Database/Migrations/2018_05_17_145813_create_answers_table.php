<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('formulaire_id')->unsigned();
			$table->foreign('formulaire_id')
				->references('id')
				->on('formulaires')
				->onDelete('cascade');
			$table->string('nom');
            $table->string('prenom');
            $table->json('content');
			$table->ipAddress('ip');
			$table->boolean('handled')->default(false);
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
        Schema::dropIfExists('answers');
    }
}
