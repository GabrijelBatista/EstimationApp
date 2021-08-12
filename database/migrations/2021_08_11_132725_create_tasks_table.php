<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->integer('best_hours')->nullable();
            $table->integer('best_minutes')->nullable();
            $table->integer('average_hours')->nullable();
            $table->integer('average_minutes')->nullable();
            $table->integer('worst_hours')->nullable();
            $table->integer('worst_minutes')->nullable();
            $table->foreignId('module_id')->constrained('modules');
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
