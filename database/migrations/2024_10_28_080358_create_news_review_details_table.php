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
        Schema::create('news_review_details', function (Blueprint $table) {
            $table->id();
            $table->string('news_page');
            $table->string('news_image');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('news_details',30000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_review_details');
    }
};
