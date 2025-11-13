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

        // 1. Логируем для диагностики
        Log::info('Telegram update received:', $update);

        // Проверяем наличие ключа 'message' и 'chat.id'
        if (!isset($update['message']['chat']['id'])) {
            Log::warning('Update does not contain message or chat id. Type: ' . (isset($update['update_id']) ? 'Update ID ' . $update['update_id'] : 'Unknown'), $update);
            return response()->json(['status' => 'no_chat_id'], 200);
        }

        $chatId = $update['message']['chat']['id'];
        $text = $update['message']['text'] ?? '[Сообщение без текста]';
        
        // 2. Логика ответа
        $replyText = "Вы написали: \"$text\"\nСпасибо за сообщение!";

        try {
            // 3. Отправка сообщения
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $replyText,
                // Добавьте 'parse_mode' => 'Markdown' или 'HTML' при необходимости
            ]);
            
            // Успешный ответ Telegram API
            return response()->json(['status' => 'reply_sent'], 200);

        } catch (\Exception $e) {
            // 4. Логируем ошибку отправки
            Log::error('Telegram sendMessage error. Check token/connection:', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
                'request_text' => $text
            ]);
            
            // Возвращаем OK для Telegram, но с сообщением об ошибке для наших логов
            return response()->json([
                'status' => 'send_failed',
                'message' => $e->getMessage()
            ], 200); 
        }
    }
}