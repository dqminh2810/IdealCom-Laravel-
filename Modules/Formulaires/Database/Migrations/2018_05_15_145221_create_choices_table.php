<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('field_id')->unsigned();
			$table->foreign('field_id')
				->references('id')
				->on('fields')
				->onDelete('cascade');
			$table->string('label');
			$table->string('value');
			$table->boolean('selected')->default(false);
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
			Schema::dropIfExists('choices');
    }
}
