<?php

namespace Tests\Feature\Tag;

use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_see_all_categories()
    {
        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();

        $response = $this->actingAs($this->createAdmin())->get('admin/tags');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('tag.index')
            ->assertViewHas('tags', function ($tags) use ($tag1, $tag2) {
                return $tags->contains($tag1) && $tags->contains($tag2);
            });
    }

    /** @test */
    function authors_can_see_all_categories()
    {
        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();

        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->get('admin/tags');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('tag.index')
            ->assertViewHas('tags', function ($tags) use ($tag1, $tag2) {
                return $tags->contains($tag1) && $tags->contains($tag2);
            });
    }

    /** @test */
    function unauthorize_cannot_see_all_categories()
    {
        $response = $this->actingAs($this->createUser())->get('admin/tags');

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee('403')
            ->assertSee('PROHIBIDO');
    }


    /** @test */
    function guests_cannot_see_all_categories()
    {
        $response = $this->get('admin/tags');

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }
}
