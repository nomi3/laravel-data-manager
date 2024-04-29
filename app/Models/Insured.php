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
        'principal_insurer',
        'affiliated_insurer',
        'insurer_number',
        'support_level',
        'gender',
        'birth_date',
        'age',
        'checkup_date',
        'height',
        'weight',
        'bmi',
        'waist',
        'systolic1',
        'systolic2',
        'systolic_other',
        'diastolic1',
        'diastolic2',
        'diastolic_other',
        'triglycerides',
        'fasting_triglycerides',
        'casual_triglycerides',
        'hdl_cholesterol',
        'ldl_cholesterol',
        'got',
        'gpt',
        'gamma_gt',
        'fasting_glucose',
        'casual_glucose',
        'hba1c',
        'medication1',
        'medication2',
        'medication3',
        'smoking',
        'initial_interview_date',
        'initial_interview_time',
        'characteristics',
    ];
}
