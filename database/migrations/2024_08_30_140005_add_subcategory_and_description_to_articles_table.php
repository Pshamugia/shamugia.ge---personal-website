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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('subcategory')->nullable(); // Add the subcategory column
            $table->text('description')->nullable(); // Add the description column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) { 
                $table->dropColumn(['subcategory', 'description']); // Remove the columns if rolling back
        });
    }
};
