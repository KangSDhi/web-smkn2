<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'name' => 'Sigit Boworaharjo',
                'email' => 'kangteknisi@gmail.com',
                'password' => bcrypt('ddhh1nn1'),
                'role_user'   => 'admin'
            )
        );

        DB::table('users')->insert($data);
    }
}
