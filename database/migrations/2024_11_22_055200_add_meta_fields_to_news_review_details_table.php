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
        Schema::table('news_review_details', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->after('brands');
            $table->string('meta_tags')->nullable()->after('news_details');; // Store tags as comma-separated values
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_review_details', function (Blueprint $table) {
            $table->dropColumn(['meta_description', 'meta_tags']);

        });
    }
};
