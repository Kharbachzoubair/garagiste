<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->enum('fuel_type', ['gasoline', 'diesel', 'hybrid']);
            $table->string('registration')->unique();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
            
            // Adding indexes
            $table->index('registration');

            // Adding foreign key
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
