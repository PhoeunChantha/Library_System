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
        Schema::create('librarians', function (Blueprint $table) {
            $table->id('LibrarianId');
            $table->string('LibrarianName', 50);
            $table->string('Sex', 50)->nullable();
            $table->date('Dob')->nullable();
            $table->string('Pob', 50)->nullable();
            $table->string('Phone', 60)->nullable();
            $table->boolean('IsHidden')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('librarians');
    }
};
