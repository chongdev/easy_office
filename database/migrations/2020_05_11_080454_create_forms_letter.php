<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsLetter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('address')->nullable();
            $table->date('date')->nullable();
            $table->string('dear')->nullable();
            $table->integer('U_id')->nullable();
            $table->string('Title')->nullable();
            $table->string('vacation_Name')->nullable();
            $table->string('etc')->nullable();
            $table->text('detail')->nullable();
            $table->date('since')->nullable();
            $table->date('todate')->nullable();
            $table->date('alltime')->nullable();
            $table->string('contacted')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->integer('approve')->nullable();
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
        //
    }
}
