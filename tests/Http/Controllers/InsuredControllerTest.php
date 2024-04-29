<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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

    public function testIndexWithoutLogin()
    {
        $response = $this->get(route('insureds.index'));
        $response->assertRedirect(route('login'));
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

    public function testSearchWithoutLogin()
    {
        $response = $this->get(route('insureds.search'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test the create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('insureds.create'));
        $response->assertOk();
        $response->assertViewIs('insureds.create');
    }

    public function testCreateWithoutLogin()
    {
        $response = $this->get(route('insureds.create'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::factory()->create();
        $file = new UploadedFile(
            public_path('test_data.csv'),
            'test_data.csv',
            'text/csv',
            null,
            true
        );
        $this->actingAs($user)->post(route('insureds.store'), [
            'csv_file' => $file,
        ]);
        $this->assertDatabaseHas('insureds', [
            'name' => '田中太郎',
        ]);
    }

    public function testStoreWithoutLogin()
    {
        $file = new UploadedFile(
            public_path('test_data.csv'),
            'test_data.csv',
            'text/csv',
            null,
            true
        );
        $response = $this->post(route('insureds.store'), [
            'csv_file' => $file,
        ]);
        $response->assertRedirect(route('login'));
    }
}
