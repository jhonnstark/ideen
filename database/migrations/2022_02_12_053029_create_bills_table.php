<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->double('discount', 3, 2)->nullable();
            $table->double('total', 8, 2);
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('payment_id')->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('bills');
    }
}
