<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends TestCase
{
    private $name = 'post';

    /** @test */
    function admins_can_create_categories()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['add_categories']);

        $this->actingAs($user)
            ->json('POST', route('categories.store'), [
                'name' => $this->name
            ])->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('categories', [
            'name' => $this->name
        ]);
    }

    /** @test */
    function admins_can_edit_categories()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['edit_categories']);

        $categoria =  factory(Category::class)->create();

        $this->actingAs($user)
            ->json('PUT', route('categories.update', $categoria->id), [
                'name' => $this->name
            ])->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('categories', [
            'id' => $categoria->id,
            'name' => $this->name
        ]);
    }

    /** @test */
    function admins_can_delete_categories()
    {
        $user = $this->getCreateUser();

        $this->userAssignPermissionToRole($user, ['delete_categories']);

        $categoria =  factory(Category::class)->create();

        $this->actingAs($user)
            ->json('DELETE', route('categories.destroy', $categoria->id), [])
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted('categories', [
            'id' => $categoria->id,
            'name' => $categoria->name
        ]);
    }

}
