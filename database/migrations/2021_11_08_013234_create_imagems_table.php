<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagem', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string("url", 200);
			$table->foreignId("clube");
			$table->foreign("clube")->references("id")->on("clube");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagem');
    }
}
