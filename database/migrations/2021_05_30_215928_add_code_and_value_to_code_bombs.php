<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeAndValueToCodeBombs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('code_bombs', function (Blueprint $table) {
            $table->float('value');
            $table->string('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('code_bombs', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->dropColumn('code');
        });
    }
}
