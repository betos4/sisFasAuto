<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identification_user' => '1719088898',
            'name_user' => 'ROBERTO CARLOS',
            'lastname_user' => 'GALLARDO INGA',
            'email_user' => 'rgallardoi@siccec.com.ec',
            'username' => 'rgallardoi',
            'password' => 'Siccec2020$$',
            'status_user' => 1,
        ]);
    }
}
