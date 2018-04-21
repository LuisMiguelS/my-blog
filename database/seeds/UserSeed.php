<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class)->create([
            'email' => 'admin@system.com',
            'name' => 'Administrador',
            'password' => '1',
            'role' => User::ADMIN_ROLE,
        ]);

        factory(User::class)->times(30)->create();
    }
}
