<?php

namespace Tests\Feature\Tag;

use Tests\TestCase;
use App\{Tag, User};
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTagTest extends TestCase
{
    use RefreshDatabase;

    private $tag_name = 'Test tag';

    /** @test */
    function admins_can_update_tags()
    {
        $this->withoutExceptionHandling();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->put("admin/tags/{$tag->id}", [
                'tag' => $this->tag_name
            ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'tag' => $this->tag_name
        ]);
    }

    /** @test */
    function authors_can_update_tags()
    {
        $tag = factory(Tag::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->put("admin/tags/{$tag->id}", [
                'tag' => $this->tag_name
            ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'tag' => $this->tag_name
        ]);
    }

    /** @test */
    function unauthorize_users_cannot_update_tags()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($this->createUser())
            ->put("admin/tags/{$tag->id}", [
                'tag' => $this->tag_name,
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->id,
            'tag' => $this->tag_name
        ]);
    }

    /** @test */
    function guests_users_cannot_update_tags()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->put("admin/tags/{$tag->id}", [
            'tag' => $this->tag_name
        ]);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->id,
            'tag' => $this->tag_name
        ]);
    }
}
