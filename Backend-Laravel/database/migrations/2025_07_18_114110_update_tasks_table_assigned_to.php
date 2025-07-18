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
        Schema::table('tasks', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['assignedTo']);
            // Change assignedTo from foreign key to string
            $table->string('assignedTo', 250)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Revert back to foreign key (if needed)
            $table->unsignedBigInteger('assignedTo')->nullable()->change();
            $table->foreign('assignedTo')->references('id')->on('users');
        });
    }
};
