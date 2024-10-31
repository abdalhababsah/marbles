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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 255);
            $table->string('name_ar', 255);
            $table->string('slug_en', 255)->unique();
            $table->string('slug_ar', 255)->unique();
            $table->text('description_en');
            $table->text('description_ar');
            $table->string('qrcode', 255)->nullable();
            $table->enum('category_type', ['featured', 'hot', 'new','normal'])->nullable();
            $table->unsignedBigInteger('category_id');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
