<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->enum('show_importance_checkbox_for', ['male', 'female', 'both', 'none'])->default('both')->after('wrong_answers');
        });

        // Migrate existing data
        DB::table('questions')->update([
            'show_importance_checkbox_for' => DB::raw('CASE 
                WHEN show_importance_checkbox = true THEN "both"
                WHEN show_importance_checkbox = false THEN "none"
            END')
        ]);

        // Drop old field
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('show_importance_checkbox');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('show_importance_checkbox')->default(true)->after('wrong_answers');
        });

        // Migrate data back
        DB::table('questions')->update([
            'show_importance_checkbox' => DB::raw('CASE 
                WHEN show_importance_checkbox_for IN ("male", "female", "both") THEN true
                WHEN show_importance_checkbox_for = "none" THEN false
            END')
        ]);

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('show_importance_checkbox_for');
        });
    }
};