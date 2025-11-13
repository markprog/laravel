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

        // Логируем полный update для отладки
        Log::info('Telegram update received:', $update);

        // Проверяем наличие сообщения и Chat ID
        if (isset($update['message']['chat']['id'])) {
            
            // 1. ПОЛУЧЕНИЕ ЧАТ ID
            $chatId = $update['message']['chat']['id'];
            
            // 2. ПОЛУЧЕНИЕ ИНФОРМАЦИИ О ПОЛЬЗОВАТЕЛЕ
            $username = $update['message']['from']['username'] ?? 'Нет_имени';
            $firstName = $update['message']['from']['first_name'] ?? 'Неизвестный';
            $text = $update['message']['text'] ?? '[Сообщение без текста]';
            
            // Формируем информационное сообщение для логов
            $logMessage = "Received message from user: **$firstName (@$username)**. Chat ID: **$chatId**";
            Log::info($logMessage);

            // 3. Логика ответа
            $replyText = "Здравствуйте, **$firstName**!\nВаш Chat ID: `$chatId`\nВы написали: \"$text\"";

            try {
                // 4. Отправка сообщения
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $replyText,
                    'parse_mode' => 'Markdown' // Используем Markdown для выделения имени и ID
                ]);
                
                return response()->json(['status' => 'reply_sent'], 200);

            } catch (\Exception $e) {
                // 5. Логируем ошибку отправки
                Log::error('Telegram sendMessage error. Check token/connection:', [
                    'error' => $e->getMessage(),
                    'chat_id' => $chatId,
                    'user' => $firstName,
                ]);
                
                return response()->json(['status' => 'send_failed', 'message' => $e->getMessage()], 200); 
            }
        } 
        
        // Возвращаем OK для других типов обновлений (например, колбэки, изменения в группе)
        return response()->json(['status' => 'ok', 'message' => 'Update received but no message chat ID found.'], 200);
    }
}