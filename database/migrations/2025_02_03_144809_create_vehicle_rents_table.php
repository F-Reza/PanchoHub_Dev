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
        Schema::create('vehicle_rents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('category');
            $table->string('title');
            $table->string('capacity');
            $table->text('facilities');
            $table->string('driver_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('upazila');
            $table->text('address')->nullable();
            $table->text('others_info')->nullable();
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
        Schema::dropIfExists('vehicle_rents');
    }
};
