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
        Schema::create('expiry_alerts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('batch_id')->constrained()->cascadeOnDelete();

    $table->string('status')->default('soon'); // soon | expired | resolved
    $table->unsignedInteger('days_threshold')->default(30);
    $table->timestamp('resolved_at')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expiry_alerts');
    }
};
