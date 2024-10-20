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
        Schema::create('scrapped_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('position');
            $table->string('company');
            $table->string('location');
            $table->string('job_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrapped_jobs');
    }
};
