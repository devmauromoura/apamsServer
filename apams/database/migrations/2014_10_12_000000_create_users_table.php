<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use ApamsServer\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('avatarUrl')->default('example');
            $table->boolean('activeAccount')->default(0);   // 0 - Não tivo   1 - Ativo
            $table->boolean('typeAccount')->default(0);  // 0 - Usuário normal, 1 - Usuário Moderador, 2 - Usuário Administrador.
            $table->rememberToken();
            $table->timestamps();
        });

        $admin = new User;
        $admin->name = "Administrador Apams";
        $admin->email = "admin@apams.com.br";
        $admin->password =  Hash::make("159357ads@");
        $admin->cellphone = "6666666666";
        $admin->avatarUrl = "apams";
        $admin->activeAccount = 1;
        $admin->typeAccount = 2;
        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
