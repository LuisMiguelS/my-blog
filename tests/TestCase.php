<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    protected function getCreateUser()
    {
        return factory(User::class)->create();
    }

    /**
     * @param User $user
     * @param $permisos
     */
    public function userAssignPermissionToRole(User $user, $permisos)
    {
        foreach ($permisos as $permiso){
            $permission[] = Permission::create(['name' => $permiso]);
        }
        $role = Role::create(['name' => User::ADMIN_ROLE]);
        $role->givePermissionTo($permission);
        $user->assignRole($role);
    }
}
