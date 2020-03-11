<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulaires', function (Blueprint $table) {
            $table->increments('id');
			$table->string('uuid');
			$table->string('title');
			$table->string('name_from')->nullable();
			$table->string('email_from')->nullable();
			$table->string('email_to')->nullable();
			$table->string('email_to_cc')->nullable();
			$table->boolean('actif')->default(false);
            $table->timestamps();
			$table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulaires');
    }
}
