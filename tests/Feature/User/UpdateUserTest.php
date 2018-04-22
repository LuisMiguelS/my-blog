<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'Test User';

    private $email = 'new_email@example.com';

    private $role = User::AUTHOR_ROLE;

    /** @test */
    function admins_can_update_users()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->put("admin/users/{$user->id}", [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $this->email,
            'role' => $this->role
        ]);
    }

    /** @test */
    function admins_cannot_update_admins()
    {
        $admin = factory(User::class)->create([
            'role' => User::ADMIN_ROLE
        ]);

        $response = $this->actingAs($this->createAdmin())
            ->put("admin/users/{$admin->id}",[
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }

    /** @test */
    function admins_cannot_update_themselves()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->put("admin/users/{$admin->id}",[
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }

    /** @test */
    function authors_cannot_update_users()
    {
        $user = factory(User::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->put("admin/users/{$user->id}", []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => $this->email,
            'role' => $this->role
        ]);
    }

    /** @test */
    function unauthorize_users_cannot_update_users()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->createUser())
            ->put("admin/users/{$user->id}", []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $this->name
        ]);
    }

    /** @test */
    function guests_users_cannot_update_categories()
    {
        $user = factory(User::class)->create();

        $response = $this->put("admin/users/{$user->id}", []);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $this->name
        ]);
    }
}
