<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Sheets API Laravel');
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        $this->client->setAccessType('offline');

        $this->service = new Google_Service_Sheets($this->client);

        // Здесь укажите ID вашего Google Sheets документа
        $this->spreadsheetId = '1b3lBHwJGS_Vdc8-EwXI_Nttu4SSJCSep5sS7IfYfdYk';
    }

    public function getSpreadsheetData($range)
    {
        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            return json_encode([]);
        }

        // Преобразование данных в JSON
        return json_encode($values);
    }
}
