<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // student_wallets 
        Schema::create('student_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate()->nullOnDelete();
            $table->decimal('total', 8, 2, true)->default(0); 
            $table->decimal('available', 8, 2, true)->default(0); 
            $table->decimal('withraw', 8, 2, true)->default(0); 
            $table->timestamps();
        });

        // student_accounts 
        $students = DB::table('students')->get();

        foreach ($students as $student) {
            
            $totalAmount = DB::table('student_accounts')->where('student_id', $student->id)->sum('amount');
            
            
            DB::table('student_wallets')->updateOrInsert(
                ['student_id' => $student->id],
                [
                    'total' => $totalAmount,  
                    'available' => $totalAmount,  
                    'withraw' => 0  
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('student_wallets');
    }
};
