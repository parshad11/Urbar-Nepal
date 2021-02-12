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
            $table->integer('transaction_id');
            $table->integer('delivery_person_id');
            $table->string('delivery_status')->default('Ordered');
            $table->string('shipping_address');
            $table->string('warehouse_address')->nullable();
            $table->string('special_delivery_instructions')->nullable();
            $table->dateTime('delivery_started_at');
            $table->dateTime('delivered_ended_at');
            $table->string('delivered_to')->nullable();
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
