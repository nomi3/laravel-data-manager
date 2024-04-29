<?php

namespace App\Usecases\Insured;

use App\Models\Insured;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Store
{
    private const HEADERS_TO_ATTRIBUTES = [
        '漢字氏名' => 'name',
        'カナ（姓）' => 'last_name_kana',
        'カナ（名）' => 'first_name_kana',
        'メールアドレス' => 'email',
        '保険証番号' => 'insurance_card_number',
        '保険証記号' => 'insurance_card_symbol',
    ];

    public function __invoke($csvFile)
    {
        try {
            $spreadsheet = $this->loadSpreadsheet($csvFile);
        } catch (\Exception $e) {
            Log::error('Failed to load spreadsheet: '.$e->getMessage());

            return false;
        }

        $worksheet = $spreadsheet->getActiveSheet();
        $headers = $this->extractHeaders($worksheet);

        $this->processRows($worksheet, $headers);

        return true;
    }

    private function loadSpreadsheet($csvFile)
    {
        $reader = new Csv();
        $reader->setEnclosure('"');
        $reader->setDelimiter(',');
        $reader->setSheetIndex(0);

        return $reader->load($csvFile);
    }

    private function extractHeaders($worksheet)
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

    private function processRows($worksheet, $headers)
    {
        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowData = [];
            foreach (self::HEADERS_TO_ATTRIBUTES as $header => $attribute) {
                $column = $headers[$header] ?? null;
                if ($column) {
                    $rowData[$attribute] = $worksheet->getCell($column.$row->getRowIndex())->getValue();
                }
            }

            Log::info("Extracted data - Name: {$rowData['name']}, Email: {$rowData['email']}, Number: {$rowData['insurance_card_number']}");

            $insured = new Insured($rowData);
            $insured->save();
        }
    }
}
