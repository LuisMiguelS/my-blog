<?php

namespace App\Console\Commands;

use App\User;
use App\RolesInstall;
use App\PermissionInstall;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = 'Admin';
        $email = $this->ask('What is your email?');
        $password = $this->secret('What is your password?');

        $admin = User::create(compact('name','email', 'password'));

        (new PermissionInstall())->install();
        (new RolesInstall())->install();

        $roles = Role::firstOrCreate(
            ['name' => User::ADMIN_ROLE],
            ['name' => User::ADMIN_ROLE]
        );

        $admin->assignRole($roles);

        $this->info("Usuario creado: {$name}, email:<{$email}>");
    }
}
