<?php

namespace Tests\Feature\Setting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function only_super_admin_can_update_basic_settings()
    {
        $super_admin = $this->createSuperAdmin();

        $response = $this->actingAs($super_admin)->put('admin/settings/blog', [
            'site_name' => 'blog',
            'contact_number' => '999-999-99999',
            'contact_email' => 'cristiangomeze@example.com',
            'address' => 'Rep. Dominicana',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('settings', [
            'value' => 'blog',
            'value' => '999-999-99999',
            'value' => 'cristiangomeze@example.com',
            'value' => 'Rep. Dominicana',
        ]);
    }


    /** @test */
    function cannot_send_invalid_json_to_route()
    {
        $super_admin = $this->createSuperAdmin();

        $response = $this->actingAs($super_admin)->put('admin/settings/invalid-json', [
            'site_name' => 'blog',
        ]);

        $response->assertStatus(Response::HTTP_CONFLICT);

        $this->assertDatabaseMissing('settings', [
            'value' => 'blog',
        ]);
    }
}
