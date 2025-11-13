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

    // ПРОВЕРКА CHAT ID
    if (isset($update['message']['chat']['id'])) {
        $chatId = 6415801830;
        
        try {
            // УБЕДИТЕСЬ, ЧТО ВЫ ЗДЕСЬ ИСПОЛЬЗУЕТЕ Telegram::bot() ИЛИ Telegram::bot('StudioMatrixBot')
            Telegram::bot('StudioMatrixBot')->sendMessage([ // <-- Используйте явное имя бота
                'chat_id' => $chatId,
                'text' => 'Тест пройден!',
            ]);
            
            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            // ... обработка ошибок отправки
        }
    }
    
    // Если Chat ID не найден, просто возвращаем OK, чтобы не вызывать 400
    return response()->json(['status' => 'ok', 'message' => 'Update processed']);
}
}