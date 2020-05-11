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
            $table->increments('id');
            $table->string('address',255)->collation('utf8_unicode_ci');
            $table->date('date');
            $table->string('dear',255)->collation('utf8_unicode_ci');
            $table->integer('U_id',11);
            $table->string('Title',255)->collation('utf8_unicode_ci');
            $table->string('vacation_Name',255)->collation('utf8_unicode_ci');
            $table->string('etc',255)->collation('utf8_unicode_ci')->nullable();
            $table->text('detail')->collation('utf8_unicode_ci');
            $table->date('since');
            $table->date('todate');
            $table->date('alltime');
            $table->string('contacted',255)->collation('utf8_unicode_ci');
            $table->string('image',255)->nullable();
            $table->string('status',20)->collation('utf8_unicode_ci');
            $table->integer('approve',11);
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
