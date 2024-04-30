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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id('BorrowId');
            $table->unsignedBigInteger('CustomerId');
            $table->foreign('CustomerId')->references('CustomerId')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('LibrarianId');
            $table->foreign('LibrarianId')->references('LibrarianId')->on('librarians')->onDelete('cascade');
            $table->date('BorrowDate');
            $table->string('BorrowCode', 60);
            $table->string('Depositamount',10, 2)->nullable();
            $table->date('Duedate');
            $table->decimal('FineAmount',10, 2)->nullable();
            $table->string('Emmo', 50)->nullable();
            $table->boolean('IsHidden')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
