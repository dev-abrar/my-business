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
        // teacher_wallets 
        Schema::create('teacher_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnUpdate()->nullOnDelete();
            $table->decimal('total', 8, 2, true)->default(0); 
            $table->decimal('available', 8, 2, true)->default(0); 
            $table->decimal('withraw', 8, 2, true)->default(0); 
            $table->timestamps();
        });

        // teacher_accounts 
        $teachers = DB::table('teachers')->get();

        foreach ($teachers as $teacher) {
            // teacher_accounts 
            $totalAmount = DB::table('teacher_accounts')->where('teacher_id', $teacher->id)->sum('amount');
            
            // teacher_wallets 
            DB::table('teacher_wallets')->updateOrInsert(
                ['teacher_id' => $teacher->id],
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
        
        Schema::dropIfExists('teacher_wallets');
    }
};
