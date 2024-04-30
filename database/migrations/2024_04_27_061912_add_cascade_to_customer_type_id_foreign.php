<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['CustomerTypeId']); // Drop the existing foreign key constraint
            $table->foreign('CustomerTypeId')
                  ->references('CustomerTypeId')
                  ->on('customertypes')
                  ->onDelete('cascade'); // Add cascade delete constraint
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['CustomerTypeId']);
            // If you need to recreate the foreign key constraint without cascade delete,
            // you can add it here
            // $table->foreign('CustomerTypeId')->references('CustomerTypeId')->on('customertypes');
        });
    }
};
