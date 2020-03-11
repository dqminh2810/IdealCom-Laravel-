<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLE Subscriber
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subscriber_name');
            $table->string('email');
            $table->boolean('actif')->default(true);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        //TABLE Group
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('group_name');
            $table->boolean('actif')->default(true);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        //TABLE Group_subcriber
        Schema::create('group_subscriber', function (Blueprint $table) {
            $table->unsignedInteger('subscriber_id');
            $table->unsignedInteger('group_id');
            $table->boolean('actif')->default(true);
            $table->timestamps();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->engine = 'InnoDB';

            // Pose un pb au niveau de l'affectation des perm à un rôle, seulement sur WAMP/W10 ?
            $table->primary(['subscriber_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('group');
        Schema::dropIfExists('group_subscribers');
    }
}
