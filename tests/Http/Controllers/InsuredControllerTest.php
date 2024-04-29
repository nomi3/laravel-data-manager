<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
            public_path('test_sample_data.csv'),
            'test_sample_data.csv',
            'text/csv',
            null,
            true
        );
        $response = $this->actingAs($user)->post(route('insureds.store'), [
            'csv_file' => $file,
        ]);
        $response->assertRedirect(route('insureds.index'));
        $this->assertDatabaseHas('insureds', [
            'name' => 'sub1',
        ]);
    }

    public function testStoreWithoutLogin()
    {
        $file = new UploadedFile(
            public_path('test_sample_data.csv'),
            'test_sample_data.csv',
            'text/csv',
            null,
            true
        );
        $response = $this->post(route('insureds.store'), [
            'csv_file' => $file,
        ]);
        $response->assertRedirect(route('login'));
    }

    public function testStoreWithoutCsvFile()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('insureds.store'));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['csv_file' => 'CSVファイルのアップロードは必須です。']);
    }

    public function testStoreWithInvalidFile()
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('invalid_file.jpg');
        $response = $this->actingAs($user)->post(route('insureds.store'), [
            'csv_file' => $file,
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['csv_file' => 'アップロードされたファイルは、CSV形式である必要があります。']);
    }
}
