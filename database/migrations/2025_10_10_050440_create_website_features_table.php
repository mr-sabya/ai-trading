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
        Schema::create('website_features', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // section title or short heading
            $table->text('description')->nullable();
            $table->string('tab_title'); // the nav item title
            $table->string('main_image')->nullable();
            $table->string('floating_top_image')->nullable();
            $table->string('floating_top_text')->nullable();
            $table->string('floating_bottom_number')->nullable();
            $table->string('floating_bottom_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_features');
    }
};
