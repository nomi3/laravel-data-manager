<?php

namespace App\Usecases\Insured;

use App\Models\Insured;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Store
{
    private const HEADERS_TO_ATTRIBUTES = [
        '漢字氏名' => 'name',
        'カナ（姓）' => 'last_name_kana',
        'カナ（名）' => 'first_name_kana',
        'メールアドレス' => 'email',
        '保険証番号' => 'insurance_card_number',
        '保険証記号' => 'insurance_card_symbol',
        '委託元保険者' => 'principal_insurer',
        '所属保険者' => 'affiliated_insurer',
        '保険者番号' => 'insurer_number',
        '支援レベル' => 'support_level',
        '性別' => 'gender',
        '生年月日' => 'birth_date',
        '年齢' => 'age',
        '健診日' => 'checkup_date',
        '身長' => 'height',
        '健診時体重' => 'weight',
        'BMI' => 'bmi',
        '健診時腹囲' => 'waist',
        '収縮期1' => 'systolic1',
        '収縮期2' => 'systolic2',
        '収縮期その他' => 'systolic_other',
        '拡張期1' => 'diastolic1',
        '拡張期2' => 'diastolic2',
        '拡張期その他' => 'diastolic_other',
        '中性脂肪' => 'triglycerides',
        '空腹時中性脂肪' => 'fasting_triglycerides',
        '随時中性脂肪' => 'casual_triglycerides',
        'HDL' => 'hdl_cholesterol',
        'LDL' => 'ldl_cholesterol',
        'GOT' => 'got',
        'GPT' => 'gpt',
        'γ-GT' => 'gamma_gt',
        '空腹時血糖' => 'fasting_glucose',
        '随時血糖' => 'casual_glucose',
        'HBA1C' => 'hba1c',
        '服薬1' => 'medication1',
        '服薬2' => 'medication2',
        '服薬3' => 'medication3',
        '喫煙' => 'smoking',
        '初回面談日' => 'initial_interview_date',
        '初回面談時間' => 'initial_interview_time',
        '対象者の特徴' => 'characteristics',
    ];

    public function __invoke(string $csvFile): bool
    {
        try {
            $spreadsheet = $this->loadSpreadsheet($csvFile);
            $worksheet = $spreadsheet->getActiveSheet();
            $headers = $this->extractHeaders($worksheet);
            $this->processRows($worksheet, $headers);
        } catch (\Exception $e) {
            Log::error('Failed to read spreadsheet: '.$e->getMessage());

            return false;
        }
        return true;
    }

    private function loadSpreadsheet(string $csvFile): Spreadsheet
    {
        $reader = new Csv();
        $reader->setEnclosure('"');
        $reader->setDelimiter(',');
        $reader->setSheetIndex(0);

        return $reader->load($csvFile);
    }

    private function extractHeaders(Worksheet $worksheet): array
    {
        $headerRow = $worksheet->getRowIterator(1)->current();
        $cellIterator = $headerRow->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);

        $headers = [];
        foreach ($cellIterator as $cell) {
            $headers[$cell->getValue()] = $cell->getColumn();
        }

        return $headers;
    }

    private function processRows(Worksheet $worksheet, array $headers): void
    {
        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowData = [];
            foreach (self::HEADERS_TO_ATTRIBUTES as $header => $attribute) {
                $column = $headers[$header] ?? null;
                if ($column) {
                    $value = $worksheet->getCell($column.$row->getRowIndex())->getValue();
                    if (in_array($attribute, ['medication1', 'medication2', 'medication3', 'smoking'])) {
                        $rowData[$attribute] = $this->getBooleanFromStr($value);
                    } else {
                        $rowData[$attribute] = $value;
                    }
                }
            }
            $insured = new Insured($rowData);
            $insured->save();
        }
    }

    private function getBooleanFromStr(string $str): bool
    {
        return in_array($str, ['はい', 'あり']);
    }
}
