<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('best_hours')->nullable();
            $table->integer('best_minutes')->nullable();
            $table->integer('average_hours')->nullable();
            $table->integer('average_minutes')->nullable();
            $table->integer('worst_hours')->nullable();
            $table->integer('worst_minutes')->nullable();
            $table->boolean('private_public')->default(false);
            $table->boolean('sent_notsent')->default(false);
            $table->boolean('approved_notapproved')->default(false);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('assigned_id')->constrained('users');
            $table->foreignId('pm_id')->constrained('users');
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
        Schema::dropIfExists('projects');
    }
}
