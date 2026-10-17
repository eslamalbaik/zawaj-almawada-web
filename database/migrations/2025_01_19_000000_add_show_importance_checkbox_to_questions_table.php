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
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('show_importance_checkbox')->default(true)->after('wrong_answers');
        });

        // Update all existing questions to show importance checkbox by default
        DB::table('questions')->update(['show_importance_checkbox' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('show_importance_checkbox');
        });
    }
};


