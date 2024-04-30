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
        $result = $usecase($file);
        $this->assertTrue($result);
        $this->assertDatabaseCount('insureds', 15);
        $this->assertDatabaseHas('insureds', [
            'name' => 'sub1',
        ]);
    }

    public function testInvokeWithoutFile()
    {
        $usecase = new Store();
        $result = $usecase('aaa');
        $this->assertNotTrue($result);
    }

    public function testInvokeWithInvalidFile()
    {
        $usecase = new Store();
        $file = new UploadedFile(
            base_path('tests/storage/test_sample_data_invalid.csv'),
            'test_sample_data_invalid.csv',
            'text/csv',
            null,
            true
        );
        $result = $usecase($file);
        $this->assertNotTrue($result);
    }

    public function testRollbackDBWhenFailed()
    {
        $this->assertDatabaseCount('insureds', 0);
        $usecase = new Store();
        $file = new UploadedFile(
            base_path('tests/storage/sample_data_with_lacking_fields.csv'),
            'sample_data_with_lacking_fields.csv',
            'text/csv',
            null,
            true
        );
        $result = $usecase($file);
        $this->assertNotTrue($result);
        $this->assertDatabaseCount('insureds', 0);
    }
}
