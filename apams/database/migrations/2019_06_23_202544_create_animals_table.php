<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('size')->nullable(); 
            $table->string('type')->nullable();  
            $table->float('weight')->nullable();
            $table->integer('age')->nullable();
            $table->string('sex', 1)->nullable(); // F || M
            $table->string('adopted')->default('0'); // 0 - Aguardando adoção   1-Em processo de adoção   2-Adotado
            $table->longText('history');
            $table->string('avatar_url', 3000)->default('');
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
        Schema::dropIfExists('animals');
    }
}
