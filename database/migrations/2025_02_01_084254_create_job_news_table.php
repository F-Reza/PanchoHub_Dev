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
        Schema::create('job_news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('job_title');
            $table->string('org_name');
            $table->string('position');
            $table->string('quantity');
            $table->string('education_qualify');
            $table->string('experience');
            $table->string('upazila');
            $table->string('address')->nullable();
            $table->string('contact');
            $table->string('email')->nullable();
            $table->string('salary');
            $table->string('dateline');
            $table->string('others_info')->nullable();
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
        Schema::dropIfExists('job_news');
    }
};
