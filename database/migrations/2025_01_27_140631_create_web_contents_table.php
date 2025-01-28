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
        Schema::create('web_contents', function (Blueprint $table) {
            $table->id();
            $table->text('desp')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->decimal('charge', 8, 2, true)->nullable();
            $table->text('quran_link')->nullable();
            $table->integer('bkash')->nullable();
            $table->integer('nagad')->nullable();
            $table->integer('rocket')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_contents');
    }
};
