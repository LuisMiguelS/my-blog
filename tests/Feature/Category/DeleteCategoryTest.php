<?php

namespace Tests\Feature\Category;

use App\Category;
use App\User;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_delete_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->delete("admin/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    /** @test */
    function authors_cannot_delete_category()
    {
        $category = factory(Category::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->delete("admin/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    /** @test */
    function unauthorize_cannot_delete_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->createUser())
            ->delete("admin/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    /** @test */
    function guests_cannot_delete_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->delete("admin/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

}
