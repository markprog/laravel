<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
{
    $update = $request->all();

    // Логируем весь update для анализа
    Log::info('Full Telegram Update:', $update);

    if (isset($update['message']['chat']['id'])) {
        $chatId = $update['message']['chat']['id'];
        
        // КЛЮЧЕВОЙ ЛОГ ДЛЯ ДИАГНОСТИКИ
        Log::info("Attempting to reply to Chat ID: {$chatId}"); 
        
        try {
            // ... Здесь ваш код Telegram::sendMessage
            // ...
            
        } catch (\Exception $e) {
            // ... здесь логируется ваша ошибка 400
            Log::error('400 Bad Request Error:', ['chat_id' => $chatId, 'error' => $e->getMessage()]);
        }
    }
    
    // ...
    return response()->json(['status' => 'ok', 'message' => 'Processed update']);
}
}