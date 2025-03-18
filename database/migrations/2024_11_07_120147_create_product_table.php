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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('brands');
            $table->string('pages_name');
            $table->string('product_label');
            $table->string('product_name');
            $table->string('product_url');
            $table->string('showroom_price');
            $table->string('on_road_price');
            $table->string('productimage1');
            $table->string('productimage2');
            $table->string('productimage3');
            $table->string('productimage4');
            $table->string('productimage5');
            $table->string('productimage6');
            $table->string('productimage7');
            $table->string('productimage8');
            $table->string('color')->nullable();
            $table->string('mileage')->nullable();
            $table->string('displacement')->nullable();
            $table->string('fule_tank_capacity')->nullable();
            $table->string('kerb_weight')->nullable();
            $table->string('height')->nullable();
            $table->string('top_speed')->nullable();
            $table->string('engine')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission_type')->nullable();
            $table->string('seating_capacity')->nullable();
            $table->string('safety')->nullable();
            $table->string('driving_range')->nullable();
            $table->string('charging_time')->nullable();
            $table->longText('highlights',50000);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
