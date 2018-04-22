<?php

namespace Tests\Feature\Post;

use App\Post;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_see_all_published_posts()
    {
        $post1 = factory(Post::class)->create([
            'status' => Post::PUBLISHED
        ]);
        $post2 = factory(Post::class)->create([
            'status' => Post::PUBLISHED
        ]);

        $response = $this->actingAs($this->createAdmin())->get('admin/posts');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('post.index')
            ->assertViewHas('posts', function ($posts) use ($post1, $post2) {
                return $posts->contains($post1) && $posts->contains($post2);
            });
    }

    /** @test */
    function author_can_only_see_their_published_posts()
    {
        $author = $this->createUser(\App\User::AUTHOR_ROLE);

        $post1 = factory(Post::class)->create([
            'user_id' => $author->id,
            'status' => Post::PUBLISHED
        ]);
        $post2 = factory(Post::class)->create();
        $post3 = factory(Post::class)->create([
            'user_id' => $author->id,
            'status' => Post::PUBLISHED
        ]);
        $post4 = factory(Post::class)->create();

        $response = $this->actingAs($author)->get('admin/posts');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('post.index')
            ->assertViewHas('posts', function ($posts) use ($post1, $post2, $post3, $post4) {
               return $posts->contains($post1) && !$posts->contains($post2)
                   && $posts->contains($post3) && !$posts->contains($post4);
            });
    }

    /** @test */
    function admin_can_only_see_their_drafts_posts()
    {
        $admin = $this->createAdmin();

        $draft1 = factory(Post::class)->create([
            'user_id' => $admin->id,
            'status' => Post::DRAFT
        ]);
        $draft2 = factory(Post::class)->create([
            'user_id' => $admin->id,
            'status' => Post::DRAFT
        ]);
        $draft3 = factory(Post::class)->create([
            'status' => Post::DRAFT
        ]);

        $response = $this->actingAs($admin)->get('admin/posts/draft');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('post.draft')
            ->assertViewHas('drafts', function ($drafts) use ($draft1, $draft2, $draft3) {
                return $drafts->contains($draft1) && $drafts->contains($draft2) && !$drafts->contains($draft3);
            });
    }

    /** @test */
    function author_can_only_see_their_drafts_posts()
    {
        $author = $this->createUser(\App\User::AUTHOR_ROLE);

        $draft1 = factory(Post::class)->create([
            'user_id' => $author->id,
            'status' => Post::DRAFT
        ]);
        $draft2 = factory(Post::class)->create([
            'user_id' => $author->id,
            'status' => Post::DRAFT
        ]);
        $draft3 = factory(Post::class)->create([
            'status' => Post::DRAFT
        ]);

        $response = $this->actingAs($author)->get('admin/posts/draft');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('post.draft')
            ->assertViewHas('drafts', function ($drafts) use ($draft1, $draft2, $draft3) {
                return $drafts->contains($draft1) && $drafts->contains($draft2) && !$drafts->contains($draft3);
            });
    }

    /** @test */
    function authorized_users_cannot_see_crud_posts()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get('admin/posts');

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee('403')
            ->assertSee('PROHIBIDO');
    }

}
