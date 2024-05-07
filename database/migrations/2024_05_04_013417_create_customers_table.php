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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('CustomerId');
            $table->string('CustomerCode', 500);
            $table->unsignedBigInteger('CustomerTypeId'); // Use unsignedBigInteger for foreign keys
            $table->foreign('CustomerTypeId')->references('CustomerTypeId')->on('customertypes')->onDelete('cascade');
            $table->string('CustomerName', 50);
            $table->string('Sex', 50)->nullable();
            $table->date('Dob')->nullable();
            $table->string('Pob', 50)->nullable();
            $table->string('Phone', 50)->nullable();
            $table->string('Address', 500)->nullable();
            $table->boolean('IsHidden')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
