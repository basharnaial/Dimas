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
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('category_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('sku')->nullable();
            $t->string('hero_image')->nullable();
            $t->text('short_description')->nullable();
            $t->longText('description')->nullable();
            $t->json('specs')->nullable(); // مواصفات مرنة
            $t->string('meta_title')->nullable();
            $t->text('meta_description')->nullable();
            $t->softDeletes();
            $t->timestamps();
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
