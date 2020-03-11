<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookies', function (Blueprint $table) {
            $table->increments('id');
						$table->string('title');
						$table->string('position');
						$table->string('banner_color');
						$table->string('banner_text');
						$table->string('banner_text_color');
						$table->string('button_color');
						$table->string('button_text');
						$table->string('button_text_color');
						$table->string('link');
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
        Schema::dropIfExists('cookies');
    }
}
