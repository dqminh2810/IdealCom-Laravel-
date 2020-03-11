<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *		'name',
	'web_agence',
	'adress',
	'complement',
	'zip_code',
	'city',
	'country',
	'website',
	'url',
	'actif',
     * @return void
     */
    public function up()
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->boolean('web_agence')->default(false);
			$table->string('address')->nullable();
			$table->string('complement')->nullable();
			$table->string('zip_code',10);
			$table->string('city')->nullable();
			$table->integer('country_id')->unsigned()->nullable();
			$table->foreign('country_id')
				->references('id')
				->on('countries')
				->onDelete('cascade');
			$table->string('website')->nullable();
			$table->string('email')->nullable();
			$table->boolean('actif');
			$table->timestamps();
			$table->engine = 'InnoDB';
        });

		Schema::create('agence_domain', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('agence_id')->unsigned()->nullable();
			$table->foreign('agence_id')
				->references('id')
				->on('agences')
				->onDelete('cascade');
			$table->integer('domain_id')->unsigned()->nullable();
			$table->foreign('domain_id')
				->references('id')
				->on('domains')
				->onDelete('cascade');
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
        Schema::dropIfExists('agences');
        Schema::dropIfExists('agence_domain');
    }
}
