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
        Schema::create('withraw_requests', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable(); 
            $table->decimal('amount', 10, 2); 
            $table->integer('method'); 
            $table->string('number'); 
            $table->string('sts')->default(0); 
            $table->text('note')->nullable(); 
            $table->timestamps(); 

            // Add foreign key constraints
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withraw_requests');
    }
};
