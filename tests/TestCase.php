<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAdmin()
    {
        return factory(User::class)->states(User::ADMIN_ROLE)->create();
    }

    protected function createUser($role = User::READER_ROLE)
    {
        return factory(User::class)->create([
            'role' => $role
        ]);
    }
}
