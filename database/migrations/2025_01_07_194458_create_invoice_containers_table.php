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
        Schema::create('invoice_containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoiceID')->constrained('invoices', 'id');
            $table->string('container');
            $table->float('size');
            $table->float('packs_pp');
            $table->float('qty');
            $table->float('gross');
            $table->float('net');
            $table->float('totalpp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_containers');
    }
};
