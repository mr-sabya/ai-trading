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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. "Meet our company"
            $table->string('highlight')->nullable(); // e.g. "our company"
            $table->string('subtitle')->nullable(); // e.g. "unless miss the opportunity"
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('image')->nullable();
            $table->string('exp_years_label')->nullable();
            $table->integer('exp_years_value')->nullable();
            $table->string('customers_label')->nullable();
            $table->string('customers_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
