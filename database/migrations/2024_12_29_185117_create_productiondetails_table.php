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
        Schema::create('productiondetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productionID')->constrained('productions', 'id');
            $table->foreignId('productID')->constrained('products', 'id');
            $table->float('qty');
            $table->date('date');
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productiondetails');
    }
};