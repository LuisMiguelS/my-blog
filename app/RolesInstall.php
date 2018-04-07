<?php


namespace App;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesInstall extends Install
{

    public function install()
    {
       $this->createRoles();
    }

    private function createRoles()
    {
        $admin_role = Role::firstOrCreate(
            ['name' => User::ADMIN_ROLE],
            ['name' => User::ADMIN_ROLE]
        );
        Role::firstOrCreate(
            ['name' => User::AUTHOR_ROLE],
            ['name' => User::AUTHOR_ROLE]
        );

        Role::firstOrCreate(
            ['name' => User::READER_ROLE],
            ['name' => User::READER_ROLE]
        );

        $admin_role->givePermissionTo(Permission::select('name')->get()->pluck('name'));

    }
}