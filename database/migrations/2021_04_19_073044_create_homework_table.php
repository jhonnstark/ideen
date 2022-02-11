<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description');
            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()
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
        Schema::dropIfExists('homework');
    }
}
