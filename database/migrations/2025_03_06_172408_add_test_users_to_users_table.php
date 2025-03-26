<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddTestUsersToUsersTable extends Migration
{
    public function up()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => 'Admin User ' . $i,
                'email' => 'adminuser' . $i . '@gmail.com',
                'password' => Hash::make('12345678'), 
                'role' => 'admin', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->where('email', 'user' . $i . '@example.com')->delete();
        }
    }
}

