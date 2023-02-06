<?php

namespace Database\Seeders;
use App\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = 
        [
            [
                'name' => 'Admin',
                'email' => 'admin_a@gumerch.co',
                'is_admin' => '1',
                'password' => bcrypt('gumerch')
            ],
            [
                'name' => 'Achmad',
                'email' => 'achmad@gumerch.co',
                'is_admin' => '0',
                'password' => bcrypt('bogor12345')
            ]
        ];
        foreach ($user as $key => $value)
            {
                User::create($value);
            }
    }
}
