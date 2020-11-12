<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetCategories()
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'user')->getJson('/api/categories');
        $response->dump();
        $response->assertStatus(200);
    }
}
