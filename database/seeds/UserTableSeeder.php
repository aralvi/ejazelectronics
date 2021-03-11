<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Abdur Rehman';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('12345678');
        $user->role = '1';
        $user->save();
        $user = new User();
        $user->name = 'Abdur Rehman';
        $user->email = 'user@user.com';
        $user->password = Hash::make('12345678');
        $user->role = '0';
        $user->save();
    }
}
