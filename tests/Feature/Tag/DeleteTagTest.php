<?php

namespace Tests\Feature\Tag;

use App\{User, Tag};
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_delete_category()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->delete("admin/tags/{$tag->id}");

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('tags', [
            'id' => $tag->id,
            'tag' => $tag->tag
        ]);
    }

    /** @test */
    function authors_cannot_delete_category()
    {
        $tag = factory(Tag::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->delete("admin/tags/{$tag->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'tag' => $tag->tag
        ]);
    }

    /** @test */
    function unauthorize_cannot_delete_category()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($this->createUser())
            ->delete("admin/tags/{$tag->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'tag' => $tag->tag
        ]);
    }

    /** @test */
    function guests_cannot_delete_category()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->delete("admin/tags/{$tag->id}");

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'tag' => $tag->tag
        ]);
    }
}
