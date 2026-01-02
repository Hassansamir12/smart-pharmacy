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
        Schema::create('batches', function (Blueprint $table) {
    $table->id();

    $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();
    $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();

    $table->string('batch_no')->nullable();
    $table->date('expiry_date');
    $table->unsignedInteger('quantity')->default(0);

    $table->decimal('buy_price', 10, 2)->nullable();
    $table->decimal('sell_price', 10, 2)->nullable();

    $table->timestamps();
});

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
