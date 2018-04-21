<?php

namespace Tests\Feature\Post;

use App\Category;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    private $title = 'Updated new post title!';

    private $seo_title = 'seo-title created new post';

    private $excerpt = 'short excerpt post...';

    private $body = 'body post...';

    private $meta_description = 'meta description post...';

    private $meta_keywords = 'meta keywords post...';

    /** @test */
    function admins_can_create_posts()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->json('POST', route('posts.store'), [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'category_id' => (factory(Category::class)->create())->id
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ]);
    }

    /** @test */
    function authorized_user_can_create_posts()
    {
        $user = $this->createUser(\App\User::AUTHOR_ROLE);

        $response = $this->actingAs($user)->json('POST', route('posts.store'), [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'category_id' => (factory(Category::class)->create())->id
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ]);
    }

    /** @test */
    function unauthorized_user_cannot_create_posts()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->json('POST', route('posts.store'), [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'category_id' => (factory(Category::class)->create())->id
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('posts', [
            'title' => $this->title,
            'seo_title' => $this->seo_title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ]);
    }
}
