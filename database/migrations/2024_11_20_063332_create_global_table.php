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
        Schema::create('global', function (Blueprint $table) {
            $table->id();
            $table->string('headerlogo');
            $table->string('favicon');
            $table->string('footerlogo');
            $table->string('instagramlink');
            $table->string('facebooklink');
            $table->string('linkedinlink');
            $table->string('youtubelink');
            $table->string('phone',10);
            $table->string('address');
            $table->string('email',);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global');
    }
};
