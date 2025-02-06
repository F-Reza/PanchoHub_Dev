<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('title');
            $table->string('category');
            $table->string('contact');
            $table->string('classess');
            $table->string('subjects');
            $table->string('time_period');
            $table->string('gender');
            $table->string('salary');
            $table->string('upazila');
            $table->string('address');
            $table->string('image')->nullable();
            $table->enum('status', ['Approved', 'In Review', 'Pending', 'Denied'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
