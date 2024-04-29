<?php

namespace App\Usecases\Insured;

use App\Models\Insured;

class Search
{
    private const SEARCH_FIELDS = [
        'name',
        'last_name_kana',
        'first_name_kana',
        'email',
        'insurance_card_number',
        'insurance_card_symbol',
    ];

    public function __invoke(array $columns)
    {
        $query = Insured::query();

        foreach (self::SEARCH_FIELDS as $field) {
            if (isset($columns[$field])) {
                $query->where($field, 'like', '%'.$columns[$field].'%');
            }
        }

        $insureds = $query->get();

        return $insureds;
    }
}
