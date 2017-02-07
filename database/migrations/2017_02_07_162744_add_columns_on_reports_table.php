<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->date('dt_call')->after('log')->nullable();
            $table->time('tm_call')->after('log')->nullable();
            $table->string('ctm_phone')->after('log')->default(null);
            $table->string('ctm_name')->after('log')->nullable();
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
            $table->dropColumn(['dt_call', 'ctm_phone', 'ctm_name']);
        });
    }
}
