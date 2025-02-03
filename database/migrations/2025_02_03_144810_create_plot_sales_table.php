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
        Schema::create('plot_sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('category');
            $table->string('title');
            $table->string('area');
            $table->string('sale_price');
            $table->text('details');
            $table->string('contact');
            $table->string('upazila');
            $table->text('address');
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
        Schema::dropIfExists('plot_sales');
    }
};
