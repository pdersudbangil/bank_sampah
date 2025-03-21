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
            $table->foreignId('reports')->constrained('reports')->onUpdate('restrict')->onDelete('restrict');
            // $table->foreignId('trash_id')->nullable()->constrained('trashes')->onUpdate('restrict')->onDelete('restrict');
            $table->string('trashes')->nullable();
            $table->string('price')->nullable();
            $table->string('total')->nullable();
            $table->string('proces')->nullable();
            $table->timestamps();
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
