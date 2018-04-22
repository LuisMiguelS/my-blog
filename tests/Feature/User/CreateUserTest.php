<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'Test User';

    private $email = 'user@example.com';

    private $password = '123456';

    private $role = User::AUTHOR_ROLE;

    /** @test */
    function admins_can_create_users()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('admin/users', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
            'role' => $this->role
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertCredentials([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }

    /** @test */
    function authors_can_create_users()
    {
        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->post('admin/users', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
            'role' => $this->role
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }

    /** @test */
    function unauthorize_user_cannot_create_users()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->post('admin/users', []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }

    /** @test */
    function guests_cannot_create_users()
    {
        $response = $this->post('admin/users', []);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('users', [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
