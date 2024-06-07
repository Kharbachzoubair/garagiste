<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_name');
            $table->string('part_reference')->unique();
            $table->string('supplier');
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
            
            // Adding indexes
            $table->index('part_reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spare_parts');
    }
};
