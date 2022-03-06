<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('subject_program', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('quart')->default(1);
            $table->tinyInteger('period')->default(1);
            $table->foreignId('subject_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('program_id')->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_program');
    }
}
