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
        Schema::create('mobile_recharges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->decimal('amount', 8, 2);
            $table->integer('operator');
            $table->integer('type');
            $table->integer('sts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_recharges');
    }
};
