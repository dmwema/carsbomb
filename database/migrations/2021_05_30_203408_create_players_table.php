<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('lastgame');
            $table->string('servers');
            $table->date('birthday');
            $table->string('adress');
            $table->string('pseudo');
            $table->string('image');
            $table->string('Codebomb');
            $table->integer('parent');
            $table->integer('boost_register');
            $table->integer('boost_parent');
            $table->string('identity');
            $table->string('rib');
            $table->string('rib_str');
            $table->integer('status');
            $table->double('solde');
            $table->integer('type');
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
        Schema::dropIfExists('players');
    }
}
