<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->double('signing_up', 8, 2)->nullable();
            $table->double('price', 8, 2);
            $table->double('discount', 5, 2)->nullable();
            $table->double('scholarship', 5, 2)->nullable();
            $table->double('total', 8, 2);
            $table->foreignId('user_id')->constrained()
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
        Schema::dropIfExists('payments');
    }
}
