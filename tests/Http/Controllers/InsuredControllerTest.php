<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsuredControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('insureds.index'));
        $response->assertOk();
        $response->assertViewIs('insureds.index');
    }

    /**
     * Test the search method.
     *
     * @return void
     */
    public function testSearch()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('insureds.search'));
        $response->assertOk();
    }
}
