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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email');
            $table->string('plan')->nullable();
            $table->integer('amount')->nullable(); // en centimes / unité demandée par FedaPay
            $table->string('currency')->default('XOF');
            $table->string('fedapay_transaction_id')->nullable();
            $table->string('status')->default('pending'); // pending, approved, declined, canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};

