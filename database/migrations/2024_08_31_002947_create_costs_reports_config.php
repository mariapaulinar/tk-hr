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
        Schema::create('costs_reports_config', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('concept_1_title');
            $table->string('concept_2_title');
            $table->string('concept_3_title');
            $table->string('concept_4_title');
            $table->string('concept_5_title');
            $table->string('concept_6_title');
            $table->string('concept_7_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs_reports_config');
    }
};
