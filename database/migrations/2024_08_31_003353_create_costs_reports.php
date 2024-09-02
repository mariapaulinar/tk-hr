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
        Schema::create('costs_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('month');
            $table->integer('year');
            $table->string('employee_code');
            $table->integer('concept_1');
            $table->integer('concept_2');
            $table->integer('concept_3');
            $table->integer('concept_4');
            $table->integer('concept_5');
            $table->integer('concept_6');
            $table->integer('concept_7');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs_reports');
    }
};
