<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Sheets;
use Illuminate\Http\Request;

class GoogleSheetToJsonController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->setUpClient();
    }

    private function setUpClient()
    {
       
        // Путь к файлу с токеном. Предполагается, что токен уже получен и сохранен в файл.
        $tokenPath = storage_path('app/google-token.json');
        
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
        } else {
            return response()->json(['error' => 'Токен доступа не найден.'], 500);
        }

        $this->client->setAccessToken($accessToken);

        // Проверка на истечение срока действия токена и его обновление
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                
                // Сохранение обновленного токена доступа
                file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
            } else {
                return response()->json(['error' => 'Токен доступа истек, и отсутствует токен обновления.'], 500);
            }
        }

         // Указываем путь к файлу credentials.json
    // Предполагается, что файл находится в директории storage/app вашего проекта Laravel
    $pathToCredentials = storage_path('app/credentials.json');

    // Проверяем, существует ли файл с учетными данными
    if (!file_exists($pathToCredentials)) {
        throw new \Exception('Файл с учетными данными не найден: ' . $pathToCredentials);
    }

    // Загружаем учетные данные и настраиваем клиента
    $this->client->setAuthConfig($pathToCredentials);
    $this->client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $this->client->setAccessType('offline');

    }

    public function viewData(Request $request)
    {
        $spreadsheetId = $request->input('spreadsheetId', '1Z7eOBqSOt98-3aYksx93drzbjHelIupF4HnaifPYTss'); // ID таблицы можно передать через параметры запроса
        $range = $request->input('range', 'Лист1!A1:C10'); // Диапазон ячеек для чтения

        $service = new Google_Service_Sheets($this->client);
        try {
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

            if (empty($values)) {
                return response()->json(['message' => 'Данные не найдены'], 404);
            } else {
                return response()->json($values);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Произошла ошибка при получении данных: ' . $e->getMessage()], 500);
        }
    }
}
