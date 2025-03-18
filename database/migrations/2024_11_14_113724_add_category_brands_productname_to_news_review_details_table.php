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
            $table->string('category')->nullable()->after('news_page'); 
            $table->string('brands')->nullable()->after('news_image');
            $table->string('product_name')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_review_details', function (Blueprint $table) {
            $table->dropColumn(['category', 'brands', 'product_name']);
        });
    }
};
