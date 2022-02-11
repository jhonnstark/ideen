<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTeachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('enrollment')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('address')->nullable();
            $table->string('municipality')->nullable();
            $table->boolean('birth_certificate')->nullable();
            $table->boolean('school_certificate')->nullable();
            $table->boolean('curp_certificate')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('curp')->nullable();
            $table->foreignId('state_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('enrollment');
            $table->dropColumn('birthday');
            $table->dropColumn('birthplace');
            $table->dropColumn('age');
            $table->dropColumn('address');
            $table->dropColumn('municipality');
            $table->dropColumn('birth_certificate');
            $table->dropColumn('school_certificate');
            $table->dropColumn('curp_certificate');
            $table->dropColumn('emergency_phone');
            $table->dropColumn('facebook');
            $table->dropColumn('curp');
            $table->dropForeign(['state_id']);
            $table->dropColumn('state_id');
        });
    }
}
