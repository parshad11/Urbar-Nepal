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
            $table->integer('assign_to');
            $table->enum('task_type',['delivery','pick-up']);
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('special_instruction')->nullable();
            $table->string('start_loc');
            $table->string('end_loc');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['pending','on process','completed'])->default('pending');
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
