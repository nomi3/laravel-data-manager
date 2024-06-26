<?php

namespace Tests\Usecases\Insured;

use App\Models\Insured;
use App\Usecases\Insured\Search;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testInvoke()
    {
        $insured = Insured::factory()->create();
        $usecase = new Search();
        $insureds = $usecase(['name' => $insured->name]);
        $this->assertEquals($insured->name, $insureds[0]->name);
    }
}
