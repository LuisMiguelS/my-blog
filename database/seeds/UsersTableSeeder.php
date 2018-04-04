<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	//Creando un usuario por defecto en la app
        $user = App\User::create([
        	'name' => 'Luis Miguel',
        	'email' => 'luis_miguel04@hotmail.es',
        	'password' => bcrypt('sannin'),
        	'admin' => 1
        ]);

        //Creando un profile por defecto al usuario
        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.jpg',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);
    }
}