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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('productCode')->unique();
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('supplier')->nullable();
            $table->decimal('purchasePrice', 10, 2)->nullable();
            $table->decimal('sellingPrice', 10, 2)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->date('expirationDate')->nullable();
            $table->date('arrivalDate')->nullable();
            $table->string('lotNumber')->nullable();
            $table->string('janCode')->nullable();
            $table->string('storageMethod')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('minimumStock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
