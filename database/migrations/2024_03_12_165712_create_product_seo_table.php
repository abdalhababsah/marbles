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
        Schema::create('product_seo', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->primary();
            $table->string('meta_title_en', 255);
            $table->string('meta_title_ar', 255);
            $table->text('meta_description_en');
            $table->text('meta_description_ar');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_seo');
    }
};
