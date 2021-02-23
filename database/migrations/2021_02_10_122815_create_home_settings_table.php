<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo_image');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('banner_images');
            $table->string('why_choose_us');
            $table->string('welcome_image');
            $table->text('welcome_description');
            $table->string('vdo_image');
            $table->string('vdo_link');
            $table->longText('faqs');
            $table->text('social_links');
            $table->string('call_section_image');
            $table->string('counter_section_image');
            $table->string('quote_background_image');
            $table->string('quote_front_image');
            $table->text('client_images');
            $table->string('google_map_link')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('home_settings');
    }
}
