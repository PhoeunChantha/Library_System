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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id('CatalogId');
            $table->string('CatalogCode', 60);
            $table->string('CatalogName', 500);
            $table->string('Isbn', 60);
            $table->string('AuthorName', 50);
            $table->string('PubliSher', 50);
            $table->string('PublishYear', 50);
            $table->string('PublisheDition', 60);
            $table->boolean('IsHidden')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
