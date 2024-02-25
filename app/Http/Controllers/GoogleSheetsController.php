<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Sheets;
use Illuminate\Http\Request;
use App\Services\GoogleSheetService;



class GoogleSheetsController extends Controller
{
    public function connect()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);
        $client->setAccessType('offline');

        $authUrl = $client->createAuthUrl();

        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        // Логика получения access token и работы с Google Sheets
    }
}
