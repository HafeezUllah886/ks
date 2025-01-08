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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customerID')->constrained('accounts', 'id');
            $table->foreignId('accountID')->constrained('accounts', 'id');
            $table->foreignId('productID')->constrained('products', 'id');
            $table->float('qty')->nullable();
            $table->float('price');
            $table->float('amount')->nullable();
            $table->string('pi');
            $table->date('date');
            $table->date('valid');
            $table->text('fi');
            $table->string('delivery_term');
            $table->string('payment_term');
            $table->string('loading_port');
            $table->string('discharge_port');
            $table->float('pp_gross');
            $table->float('pp_net');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
