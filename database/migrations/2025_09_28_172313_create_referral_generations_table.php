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
        Schema::create('referral_generations', function (Blueprint $table) {
            $table->id();
            $table->integer('generation');                 // 1,2,3,...
            $table->decimal('commission_percent', 5, 2);  // e.g., 10, 4, 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_generations');
    }
};
