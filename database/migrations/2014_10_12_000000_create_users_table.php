<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name',255)->collation('utf8_unicode_ci');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('lastname')->collation('utf8_unicode_ci');
            $table->integer('position',2);
            $table->integer('department');
            $table->string('prefix',10);
            $table->string('profile',255)->nullable();;
            $table->boolean('type')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
