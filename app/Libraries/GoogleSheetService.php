<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('CodeIgniter 4 Google Sheets');
        $this->client->setScopes([Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(APPPATH . 'Credentials/credentials.json'); // arahkan ke file credentials
        $this->client->setAccessType('offline');

        $this->service = new Sheets($this->client);
    }

    public function readSheet($spreadsheetId, $range)
    {
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    }

    public function appendData($spreadsheetId, $range, $values)
    {
        $body = new \Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);
        $params = ['valueInputOption' => 'RAW'];

        $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }

    public function clearAndWrite($spreadsheetId, $range, $values)
    {
        // Hapus dulu isi sheet (opsional, supaya bersih)
        $clear = new \Google\Service\Sheets\ClearValuesRequest();
        $this->service->spreadsheets_values->clear($spreadsheetId, $range, $clear);

        // Tulis data baru
        $body = new \Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);
        $params = ['valueInputOption' => 'RAW'];
        $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    }

    public function clearAndWriteToSheetByTitle($spreadsheetId, $sheetTitle, $values)
    {
        $service = $this->service;

        // Cek apakah sheet dengan judul sudah ada, jika tidak, buat
        $spreadsheet = $service->spreadsheets->get($spreadsheetId);
        $sheetId = null;

        foreach ($spreadsheet->getSheets() as $sheet) {
            if ($sheet->getProperties()->getTitle() === $sheetTitle) {
                $sheetId = $sheet->getProperties()->getSheetId();
                break;
            }
        }

        // Jika belum ada sheet, tambahkan
        if ($sheetId === null) {
            $addSheetRequest = new \Google\Service\Sheets\Request([
                'addSheet' => [
                    'properties' => [
                        'title' => $sheetTitle
                    ]
                ]
            ]);

            $batchUpdateRequest = new \Google\Service\Sheets\BatchUpdateSpreadsheetRequest([
                'requests' => [$addSheetRequest]
            ]);

            $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
        }

        // Tentukan range penulisan mulai dari A1 di sheet dengan nama tersebut
        $range = $sheetTitle . '!A1';

        // Kosongkan sheet dulu
        $bodyClear = new \Google\Service\Sheets\ClearValuesRequest();
        $service->spreadsheets_values->clear($spreadsheetId, $range, $bodyClear);

        // Tulis data baru
        $body = new \Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];
        $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    }
}
