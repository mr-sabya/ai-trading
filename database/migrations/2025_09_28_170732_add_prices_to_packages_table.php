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
        Schema::table('packages', function (Blueprint $table) {
            $table->decimal('first_price', 10, 2)->default(0)->after('billing_cycle');
            $table->decimal('renew_price', 10, 2)->default(0)->after('first_price');
            $table->dropColumn('price'); // remove old single price if you want
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['first_buy_price', 'renew_price']);
        });
    }
};
