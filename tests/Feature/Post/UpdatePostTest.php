<?php

namespace Tests\Feature\Post;

use App\Post;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_update_posts()
    {
        $post = factory(Post::class)->create();

        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->json('PUT',route('posts.update', $post), [
            'title' => 'Updated new post title!',
            'seo_title' => $post->seo_title,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'meta_description' => $post->meta_description,
            'meta_keywords' => $post->meta_keywords,
            'category_id' => $post->category_id,
            'status' => $post->status
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', [
           'id' => $post->id,
           'title' => 'Updated new post title!'
        ]);
    }

    /** @test */
    function authors_can_update_posts()
    {
        $author = $this->createUser();

        $post = factory(Post::class)->create([
            'user_id' => $author->id
        ]);

        $response = $this->actingAs($author)->json('PUT',route('posts.update', $post), [
            'title' => 'Updated new post title!',
            'seo_title' => $post->seo_title,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'meta_description' => $post->meta_description,
            'meta_keywords' => $post->meta_keywords,
            'category_id' => $post->category_id,
            'status' => $post->status
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated new post title!'
        ]);
    }

    /** @test */
    function unauthorized_users_cannot_update_posts()
    {
        $post = factory(Post::class)->create();

        $user = $this->createUser();

        $response = $this->actingAs($user)->json('PUT',route('posts.update', $post), [
            'title' => 'Updated new post title!',
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'title' => 'Updated new post title!'
        ]);
    }

    /** @test */
    function guests_cannot_update_posts()
    {
        $post = factory(Post::class)->create();

        $response = $this->json('PUT',route('posts.update', $post), [
            'title' => 'Updated new post title!',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'title' => 'Updated new post title!'
        ]);
    }
}
