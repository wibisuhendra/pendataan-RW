<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.adm',
                'password' => bcrypt('admin'),

            ]
        ];

        foreach ($users as $key => $value) {
            App\User::create($value);
        }
    }
}
