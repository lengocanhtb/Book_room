<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'telephone' => '0911111111',
            'fullname' => 'Nguyen Van A',
            'email' =>'admin@gmail.com',
            'role' => '1',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'username' => 'user',
            'telephone' => '09999999999',
            'fullname' => 'Nguyen Van B',
            'email' =>'user@gmail.com',
            'role' => '0',
            'password' => bcrypt('user')
        ]);
    }
}
