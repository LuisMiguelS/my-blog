<?php

namespace Tests\Feature\Category;

use App\Category;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_see_all_categories()
    {
        $category1 = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $response = $this->actingAs($this->createAdmin())->get('admin/categories');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('category.index')
            ->assertViewHas('categories', function ($categories) use ($category1, $category2) {
                return $categories->contains($category1) && $categories->contains($category2);
            });
    }

    /** @test */
    function authors_can_see_all_categories()
    {
        $category1 = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->get('admin/categories');

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('category.index')
            ->assertViewHas('categories', function ($categories) use ($category1, $category2) {
                return $categories->contains($category1) && $categories->contains($category2);
            });
    }

    /** @test */
    function unauthorize_cannot_see_all_categories()
    {
        $response = $this->actingAs($this->createUser())->get('admin/categories');

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee('403')
            ->assertSee('PROHIBIDO');
    }


    /** @test */
    function guests_cannot_see_all_categories()
    {
        $response = $this->get('admin/categories');

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

}
