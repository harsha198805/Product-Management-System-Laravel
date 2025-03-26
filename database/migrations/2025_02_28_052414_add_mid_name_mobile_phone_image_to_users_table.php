<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMidNameMobilePhoneImageToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik_name')->nullable()->after('email');
            $table->string('mobile')->nullable()->after('nik_name');
            $table->string('phone')->nullable()->after('mobile');
            $table->string('image')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nik_name');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
            $table->dropColumn('image');
        });
    }
}

