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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('name');
            $table->string('number');
            $table->string('district');
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('extra_address')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('commision')->nullable();
            $table->integer('qty');
            $table->decimal('total', 8,2, true);
            $table->integer('sts')->default(0);
            
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->nullOnDelete();

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
