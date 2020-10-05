<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('address')->nullable();
            $table->string('address_ext')->nullable();
            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('state_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
