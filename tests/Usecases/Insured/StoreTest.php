<?php

namespace Tests\Usecases\Insured;

use App\Usecases\Insured\Store;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function testInvoke()
    {
        $usecase = new Store();
        $file = new UploadedFile(
            base_path('tests/storage/test_sample_data.csv'),
            'test_sample_data.csv',
            'text/csv',
            null,
            true
        );
        $usecase($file);
        $this->assertDatabaseHas('insureds', [
            'name' => 'sub1',
        ]);
    }
}
