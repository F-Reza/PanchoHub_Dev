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
        Schema::create('blood_needers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('blood_gorup');
            $table->string('bag_amounts');
            $table->string('dateline');
            $table->string('contact');
            $table->string('gender');
            $table->string('upazila');
            $table->string('hp_address');
            $table->string('details')->nullable();
            $table->string('gift')->nullable();
            $table->enum('status', ['Approved', 'In Review', 'Pending', 'Denied'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_needers');
    }
};
