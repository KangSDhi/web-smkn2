<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'name' => 'Sigit Author',
                'email' => 'kangauthor@gmail.com',
                'password' => bcrypt('ddhh1nn1'),
                'role_user'   => 'author'
            )
        );

        DB::table('users')->insert($data);
    }
}
