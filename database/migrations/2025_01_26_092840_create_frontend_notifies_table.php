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
        Schema::create('frontend_notifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable(); 
            $table->string('title');
            $table->integer('sts')->default(0);
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_notifies');
    }
};
