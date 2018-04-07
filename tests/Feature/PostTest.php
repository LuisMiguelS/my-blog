<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostTest extends TestCase
{
    private $title = 'Este Es UN TITULO de Prueba';
    private $content = 'Test Laravel';
    private $tags = 'Cool,Hola Mundo';

    /** @test */
    function users_with_permission_to_create_posts_can_create_posts()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['add_posts']);

        Storage::fake('thumbnails');

        $category = factory(Category::class)->create();

         $this->actingAs($user)->json('POST', route('posts.store'), [
             'thumbnails' => UploadedFile::fake()->image('thumbnails.jpg'),
             'title' => $this->title,
             'content' => $this->content,
             'category_id' => $category->id,
             'tags' => $this->tags
        ])->assertStatus(Response::HTTP_FOUND);

         $this->assertDatabaseHas('posts', [
             'title' => $this->title,
             'content' => $this->content,
             'category_id' => $category->id,
             'slug' => str_slug($this->title, '-')
         ]);

        Storage::disk('thumbnails')->assertMissing('thumbnails.jpg');
    }

    /** @test */
    function users_with_permission_to_edit_posts_can_edit_posts()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['add_posts']);

        Storage::fake('thumbnails');

        factory(Category::class)->create();

        $post = factory(Post::class)->create();

        $this->actingAs($user)->json('PUT', route('posts.update', $post->id), [
            'thumbnails' => UploadedFile::fake()->image('thumbnails.jpg'),
            'title' => $this->title,
            'content' => $post->content,
            'category_id' => $post->category_id,
            'tags' => $post->tags
        ])->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'content' => $post->content,
            'category_id' => $post->id,
            'slug' => str_slug($post->title, '-')
        ]);

        Storage::disk('thumbnails')->assertMissing('thumbnails.jpg');
    }

    /** @test */
    function users_with_permission_to_delete_posts_can_delete_posts()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['delete_posts']);

        factory(Category::class)->create();

        $post = factory(Post::class)->create();

        $this->actingAs($user)->json('DELETE', route('posts.destroy', $post->id), [])
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }
}
