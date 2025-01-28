<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('product_name');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('after_discount', 8, 2);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->longText('long_desp')->nullable();
            $table->string('preview')->nullable();
            $table->string('sku');
            $table->string('slug');
            $table->string('commision')->nullable();
            $table->string('qty');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('slug');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
