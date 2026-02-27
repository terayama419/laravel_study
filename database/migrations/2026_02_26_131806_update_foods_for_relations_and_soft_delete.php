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
        Schema::table('foods', function (Blueprint $table) {
            $table->unsignedBigInteger('manufacturerId')->nullable()->after('name');
            $table->unsignedBigInteger('supplierId')->nullable()->after('manufacturerId');
            $table->timestamp('deleteTimestamp')->nullable()->after('minimumStock');

            $table->dropColumn(['manufacturer', 'supplier']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->string('manufacturer')->nullable();
            $table->string('supplier')->nullable();

            $table->dropColumn(['manufacturerId', 'supplierId', 'deleteTimestamp']);
        });
    }
};
