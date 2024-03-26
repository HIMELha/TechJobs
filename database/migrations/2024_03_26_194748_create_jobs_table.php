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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained()->onDelete('cascade');
            $table->string('vacancy');
            $table->string('min_salary')->nullable();
            $table->string('max_salary')->nullable();
            $table->longText('description');
            $table->longText('benifits');
            $table->longText('responsibility')->nullable();
            $table->longText('qualifications')->nullable();
            $table->string('experience')->nullable();
            $table->string('keywords');
            $table->string('company_name');
            $table->string('company_location');
            $table->string('company_website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
