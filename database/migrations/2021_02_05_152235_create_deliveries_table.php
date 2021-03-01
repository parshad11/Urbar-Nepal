<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->bigInteger('delivery_person_id')->unsigned();
            $table->foreign('delivery_person_id')->references('id')->on('delivery_people')->onDelete('cascade');
            $table->string('delivery_status')->default('Ordered');
            $table->string('shipping_address');
            $table->string('shipping_latitude')->nullable();
            $table->string('shipping_longitude')->nullable();
            $table->string('pickup_address');
            $table->string('pickup_latitude')->nullable();
            $table->string('pickup_longitude')->nullable();
            $table->string('special_delivery_instructions')->nullable();
            $table->dateTime('delivery_started_at')->nullable();
            $table->dateTime('delivery_ended_at')->nullable();
            $table->string('delivered_to')->nullable();
            $table->integer('assigned_by')->unsigned();
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
}
