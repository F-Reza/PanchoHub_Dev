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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('category');
            $table->string('title');
            $table->string('est_year');
            $table->text('details');
            $table->text('type');
            $table->string('contact');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('institutions');
    }
};
