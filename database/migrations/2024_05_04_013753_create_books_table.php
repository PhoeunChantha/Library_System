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
        Schema::create('books', function (Blueprint $table) {
            $table->id('BookId');
            // $table->string('BookName', 60);
            $table->string('BookCode', 60)->unique();
            $table->unsignedBigInteger('CatalogId');
            $table->foreign('CatalogId')->references('CatalogId')->on('catalogs')->onDelete('cascade');
            $table->text('BookImage')->nullable();
            $table->string('BookDescription', 50);
            $table->boolean('IsHidden')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
