<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_abouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_image')->nullable();
            $table->string('what_sub_title')->nullable();
            $table->string('what_description')->nullable();
            $table->string('what_image')->nullable();
            $table->string('why_sub_title')->nullable();
            $table->string('why_description')->nullable();
            $table->string('why_short_points')->nullable();
            $table->string('why_image')->nullable();
            $table->string('added_by');
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
        Schema::dropIfExists('front_abouts');
    }
}
