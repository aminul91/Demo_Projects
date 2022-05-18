<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'Omar', 'email'=>'omar@gmail.com','password'=>'123456'],
            ['name'=>'Sharif', 'email'=>'sharif@gmail.com','password'=>'123456'],
            ['name'=>'Rajme', 'email'=>'rajme@gmail.com','password'=>'123456'],
        ];

        User::insert($users);
    }
}
