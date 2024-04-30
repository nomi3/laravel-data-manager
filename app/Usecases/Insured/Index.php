<?php

namespace App\Usecases\Insured;

use App\Models\Insured;
use Illuminate\Database\Eloquent\Collection;

class Index
{
    public function __invoke(): Collection
    {
        $insureds = Insured::latest()->get();

        return $insureds;
    }
}
