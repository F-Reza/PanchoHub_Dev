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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->uid();
            $table->string('dr_name');
            $table->string('category');
            $table->string('education_qualify');
            $table->string('current_servise');
            $table->text('spacialist');
            $table->string('chambers')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Active', 'Deactive'])->default('Deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
