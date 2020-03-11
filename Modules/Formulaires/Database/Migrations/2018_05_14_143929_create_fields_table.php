<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('fields', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('position')->unsigned();
			$table->integer('formulaire_id')->unsigned();
			$table->foreign('formulaire_id')
				->references('id')
				->on('formulaires')
				->onDelete('cascade');
			$table->boolean('backoffice');
			$table->string('label_bo');
			$table->string('label_fo');
			$table->string('type');
			$table->boolean('required');
			$table->string('placeholder')->nullable();
			$table->string('value')->nullable();
			$table->float('min')->nullable();
			$table->float('max')->nullable();
			$table->float('step')->nullable();
			$table->integer('col')->nullable();
			$table->integer('rows')->nullable();
			$table->string('accept')->nullable();
			$table->boolean('multiple')->nullable();
			$table->string('tag')->nullable();
			$table->string('class')->nullable();
			$table->string('error_messages')->nullable();
			$table->boolean('actif')->default(true);
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
        Schema::dropIfExists('fields');
    }
}
