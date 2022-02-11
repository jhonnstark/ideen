<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('id');
            $table->string('enrollment')->nullable()->after('phone');
            $table->boolean('birth_certificate')->nullable();
            $table->boolean('school_certificate')->nullable();
            $table->boolean('curp_certificate')->nullable();
            $table->string('municipality')->nullable()->after('address');
            $table->string('birthplace')->nullable()->after('birthday');
            $table->string('emergency_phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('curp')->nullable();
            $table->dropColumn('gender');
            $table->dropColumn('address_ext');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('enrollment');
            $table->dropColumn('birth_certificate');
            $table->dropColumn('school_certificate');
            $table->dropColumn('curp_certificate');
            $table->dropColumn('municipality');
            $table->dropColumn('birthplace');
            $table->dropColumn('emergency_phone');
            $table->dropColumn('facebook');
            $table->dropColumn('curp');

            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address_ext')->nullable();
        });
    }
}
