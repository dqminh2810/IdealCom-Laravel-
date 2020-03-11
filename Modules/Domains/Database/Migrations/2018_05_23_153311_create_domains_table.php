<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
			$table->string('code');
			$table->string('name');
			$table->string('display_name');
			$table->string('extension');
			$table->string('google_analytics')->nullable();
			$table->string('google_webmastertool')->nullable();
			$table->string('google_maps')->nullable();
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')
				->references('id')
				->on('countries')
				->onDelete('cascade');
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
        Schema::dropIfExists('domains');
    }
}
