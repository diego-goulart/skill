<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateReportsTableForeings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign('reports_owner_id_foreign');
            $table->foreign('owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->dropForeign('reports_operador_id_foreign');
            $table->foreign('operador_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('reports_owner_id_foreign');
            $table->foreign('owner_id')->references('id')->on('users');

            $table->dropForeign('reports_operador_id_foreign');
            $table->foreign('operador_id')->references('id')->on('users');
        });
    }
}
