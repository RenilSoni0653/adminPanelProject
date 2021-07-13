<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CountryCityState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countrycitystates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('country_name');
            $table->integer('country_id');
            $table->string('state_name');
            $table->integer('state_id');
            $table->string('city_name');
            $table->integer('city_id');
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
        Schema::dropIfExists('countrycitystates');
    }
}
