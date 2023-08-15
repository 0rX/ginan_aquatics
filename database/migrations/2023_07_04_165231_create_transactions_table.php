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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->integer('total_amount');
            $table->enum('status', ['in_cart', 'in_progress', 'on_delivery', 'success', 'cancelled'])->default('in_cart');
            $table->text('shipping_address')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
