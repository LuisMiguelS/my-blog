<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\{User, Category};
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'Test Category';

    /** @test */
    function admins_can_update_categories()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->createAdmin())
            ->put("admin/categories/{$category->id}", [
                'name' => $this->name,
            ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $this->name
        ]);
    }

    /** @test */
    function authors_cannot_update_categories()
    {
        $category = factory(Category::class)->create();

        $authors = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($authors)
            ->put("admin/categories/{$category->id}", [
                'name' => $this->name,
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    /** @test */
    function unauthorize_users_cannot_update_categories()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->createUser())
            ->put("admin/categories/{$category->id}", [
                'name' => $this->name,
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
            'name' => $this->name
        ]);
    }

    /** @test */
    function guests_users_cannot_update_categories()
    {
        $category = factory(Category::class)->create();

        $response = $this->put("admin/categories/{$category->id}", [
            'name' => $this->name,
        ]);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
            'name' => $this->name
        ]);
    }

}
