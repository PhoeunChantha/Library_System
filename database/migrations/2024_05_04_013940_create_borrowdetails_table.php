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
        Schema::create('borrowdetails', function (Blueprint $table) {
            $table->id('BorrowDetailId');
            $table->unsignedBigInteger('BorrowId')->nullable();
            $table->foreign('BorrowId')->references('BorrowId')->on('borrows');
            $table->unsignedBigInteger('BookId')->nullable();
            $table->foreign('BookId')->references('BookId')->on('books');
            $table->string('book_ids',50);
            $table->string('Note', 500);
            $table->boolean('IsReturn');
            $table->date('ReturnDate')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowdetails');
    }
};
