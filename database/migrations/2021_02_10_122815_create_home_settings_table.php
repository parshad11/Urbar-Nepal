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
            $table->string('logo_image')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('banner_images')->nullable();
            $table->longText('why_choose_us')->nullable();
            $table->string('welcome_image')->nullable();
            $table->text('welcome_description')->nullable();
            $table->string('vdo_image')->nullable();
            $table->string('vdo_link')->nullable();
            $table->longText('faqs')->nullable();
            $table->text('social_links')->nullable();
            $table->string('call_section_image')->nullable();
            $table->string('counter_section_image')->nullable();
            $table->string('quote_background_image')->nullable();
            $table->string('quote_front_image')->nullable();
            $table->text('client_images')->nullable();
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
