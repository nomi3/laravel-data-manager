<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
