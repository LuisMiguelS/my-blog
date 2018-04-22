<?php

namespace Tests\Feature\Category;

use App\User;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'Test Category';

    /** @test */
    function admins_can_create_categories()
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('admin/categories', [
            'name' => $this->name
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('categories', [
            'name' => $this->name,
        ]);
    }

    /** @test */
    function authors_can_create_categories()
    {
        $author = $this->createUser(User::AUTHOR_ROLE);

        $response = $this->actingAs($author)->post('admin/categories', [
            'name' => $this->name
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('categories', [
            'name' => $this->name,
        ]);
    }

    /** @test */
    function unauthorize_user_cannot_create_categories()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->post('admin/categories', [
            'name' => $this->name
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('categories', [
            'name' => $this->name,
        ]);
    }

    /** @test */
    function guests_cannot_create_categories()
    {
        $response = $this->post('admin/categories', [
            'name' => $this->name
        ]);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('categories', [
            'name' => $this->name,
        ]);
    }

}
