<?php

namespace Tests\Feature\Post;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    function admin_can_delete_published_posts()
    {
        $admin = $this->createAdmin();

        $post1 = factory(Post::class)->create([
            'status' => Post::PUBLISHED
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::PUBLISHED,
            'user_id' => $admin->id
        ]);

        $response = $this->actingAs($admin);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('posts', [
           'id' => $post1->id,
           'title' => $post1->title
        ]);

        $this->assertSoftDeleted('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

    /** @test*/
    function author_cannnot_delete_published_posts()
    {
        $author = $this->createUser();

        $post1 = factory(Post::class)->create([
            'status' => Post::PUBLISHED
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::PUBLISHED,
            'user_id' => $author->id
        ]);

        $response = $this->actingAs($author);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('posts', [
            'id' => $post1->id,
            'title' => $post1->title
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

    /** @test*/
    function admin_cannot_delete_author_draft_posts()
    {
        $admin = $this->createAdmin();

        $post1 = factory(Post::class)->create([
            'status' => Post::DRAFT
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::DRAFT,
        ]);

        $response = $this->actingAs($admin);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('posts', [
            'id' => $post1->id,
            'title' => $post1->title
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

    /** @test*/
    function admin_can_delete_their_draft_posts()
    {
        $admin = $this->createAdmin();

        $post1 = factory(Post::class)->create([
            'status' => Post::DRAFT,
            'user_id' => $admin->id
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::DRAFT,
            'user_id' => $admin->id
        ]);

        $response = $this->actingAs($admin);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('posts', [
            'id' => $post1->id,
            'title' => $post1->title
        ]);

        $this->assertSoftDeleted('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

    /** @test*/
    function author_can_delete_their_draft_posts()
    {
        $author = $this->createUser(User::AUTHOR_ROLE);

        $post1 = factory(Post::class)->create([
            'status' => Post::DRAFT,
            'user_id' => $author->id
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::DRAFT,
            'user_id' => $author->id
        ]);

        $response = $this->actingAs($author);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('posts', [
            'id' => $post1->id,
            'title' => $post1->title
        ]);

        $this->assertSoftDeleted('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

    /** @test*/
    function unauthorize_user_cannot_delete_any_posts()
    {
        $user = $this->createUser();

        $post1 = factory(Post::class)->create([
            'status' => Post::DRAFT,
            'user_id' => $user->id
        ]);

        $post2 = factory(Post::class)->create([
            'status' => Post::PUBLISHED,
        ]);

        $response = $this->actingAs($user);

        $response->delete($post1->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $response->delete($post2->url->delete)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('posts', [
            'id' => $post1->id,
            'title' => $post1->title
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post2->id,
            'title' => $post2->title
        ]);
    }

}
