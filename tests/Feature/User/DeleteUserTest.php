<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_delete_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->delete("admin/users/{$user->id}");

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('users', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }

    /** @test */
    function admins_cannot_update_admins()
    {
        $other_admin = factory(User::class)->create([
            'role' => User::ADMIN_ROLE
        ]);

        $response = $this->actingAs($this->createAdmin())
            ->delete("admin/users/{$other_admin->id}",[]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('users', [
            'id' => $other_admin->id,
            'email' => $other_admin->email,
            'role' => $other_admin->role
        ]);
    }

    /** @test */
    function admins_cannot_update_themselves()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->delete("admin/users/{$admin->id}",[]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'email' => $admin->email,
            'role' => $admin->role
        ]);
    }

    /** @test */
    function authors_cannot_delete_user()
    {
        $user = factory(User::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->delete("admin/users/{$user->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }

    /** @test */
    function unauthorize_cannot_delete_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->createUser())
            ->delete("admin/users/{$user->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }

    /** @test */
    function guests_cannot_delete_user()
    {
        $user = factory(User::class)->create();

        $response = $this->delete("admin/users/{$user->id}");

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }
}
