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
        Schema::table('pages', function (Blueprint $table) {
            $table->text('banner_image')->after('email')->default('');
            $table->text('about')->after('mobile')->default('');
            $table->text('education')->after('mobile')->default('');
            $table->text('experience')->after('mobile')->default('');
            $table->text('website')->after('mobile')->default('');
            $table->text('facebook')->after('mobile')->default('');
            $table->text('linkedin')->after('mobile')->default('');
            $table->text('github')->after('mobile')->default('');
            $table->text('twitter')->after('mobile')->default('');
            $table->text('whatsapp')->after('mobile')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('about');
            $table->dropColumn('banner_image');
            $table->dropColumn('education');
            $table->dropColumn('experience');
            $table->dropColumn('website');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
            $table->dropColumn('github');
            $table->dropColumn('twitter');
            $table->dropColumn('whatsapp');
        });
    }
};
