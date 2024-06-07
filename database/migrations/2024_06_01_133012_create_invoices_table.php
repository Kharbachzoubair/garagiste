<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_id');
            $table->decimal('additional_charges', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->timestamps();

            // Adding indexes
            $table->index('repair_id');

            // Adding foreign key
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
