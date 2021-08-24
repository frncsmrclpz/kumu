<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKumuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login');
            $table->string('company');
            $table->bigInteger('followers');
            $table->bigInteger('repo');
            $table->bigInteger('average');
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
        Schema::dropIfExists('kumus');
    }
}
