<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('reports', function (Blueprint $table) {
		    $table->increments('id');

		    $table->integer('owner_id')->unsigned();
		    $table->foreign('owner_id')->references('id')->on('users');

		    $table->integer('operador_id')->unsigned();
		    $table->foreign('operador_id')->references('id')->on('users');

		    $table->boolean('owner_signature')->nullable();
		    $table->boolean('operador_signature')->nullable();

		    $table->json('log');

		    $table->decimal('total');
		    $table->text('obs')->nullable();

		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('reports');
    }
}
