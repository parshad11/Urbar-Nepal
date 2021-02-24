<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');
            $table->bigInteger('delivery_person_id')->unsigned();
            $table->foreign('delivery_person_id')->references('id')->on('delivery_people')->onDelete('cascade');
            $table->string('task_type')->default('delivery');
            $table->string('task_status')->default('received');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('special_instructions')->nullable();
            $table->string('task_address')->nullable();
            $table->string('task_latitude');
            $table->string('task_longitude');
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
