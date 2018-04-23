<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
        function admins_can_see_all_users()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $response = $this->actingAs($this->createAdmin())->get('admin/users');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('user.index')
            ->assertViewHas('users', function ($users) use ($user1, $user2) {
                return $users->contains($user1) && $users->contains($user2);
            });
    }

    /** @test */
    function authors_can_see_all_users()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->get('admin/users');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('user.index')
            ->assertViewHas('users', function ($users) use ($user1, $user2) {
                return $users->contains($user1) && $users->contains($user2);
            });
    }

    /** @test */
    function unauthorize_cannot_see_all_users()
    {
        $response = $this->actingAs($this->createUser())->get('admin/users');

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee('403')
            ->assertSee('PROHIBIDO');
    }


    /** @test */
    function guests_cannot_see_all_users()
    {
        $response = $this->get('admin/users');

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }
}
