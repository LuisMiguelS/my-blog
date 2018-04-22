<?php

namespace Tests\Feature\Tag;

use App\User;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTagTest extends TestCase
{
    use RefreshDatabase;

    private $tag = 'Test tag';

    /** @test */
    function admins_can_create_tags()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('admin/tags', [
            'tag' => $this->tag
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('tags', [
            'tag' => $this->tag,
        ]);
    }

    /** @test */
    function authors_can_create_tags()
    {
        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->post('admin/tags', [
            'tag' => $this->tag
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('tags', [
            'tag' => $this->tag,
        ]);
    }

    /** @test */
    function unauthorize_user_cannot_create_tags()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->post('admin/tags', [
            'tag' => $this->tag
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('tags', [
            'tag' => $this->tag,
        ]);
    }

    /** @test */
    function guests_cannot_create_tags()
    {
        $response = $this->post('admin/tags', [
            'tag' => $this->tag
        ]);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('tags', [
            'tag' => $this->tag,
        ]);
    }
}
