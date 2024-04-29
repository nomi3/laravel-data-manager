<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'first_name_kana',
        'last_name_kana',
        'insurance_card_symbol',
        'insurance_card_number',
        'email',
    ];
}
