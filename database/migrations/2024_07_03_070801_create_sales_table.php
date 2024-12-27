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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customerID')->constrained('accounts', 'id');
            $table->date('date');
            $table->date('dueDate')->nullable();
            $table->float('discount')->default(0);
            $table->float('tax')->default(0);
            $table->float('taxValue')->default(0);
            $table->float('exlusive')->default(0);
            $table->float('total')->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
