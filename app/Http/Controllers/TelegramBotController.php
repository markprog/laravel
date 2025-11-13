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

        // 1. Проверяем, что это сообщение, и получаем Chat ID
        if (isset($update['message']['chat']['id'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? 'no text';

            // 2. Логируем для подтверждения, что дошли сюда
            Log::info("✅ Webhook hit. Attempting to reply to Chat ID: {$chatId}");

            try {
                // 3. Отправка фиксированного тестового сообщения
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Тест пройден! Ответ отправлен.',
                ]);

                // 4. Если отправка успешна, логируем успех
                Log::info("✅ Reply success to {$chatId}.");
                
                return response()->json(['status' => 'ok', 'message' => 'Reply sent']);

            } catch (\Exception $e) {
                // 5. Логируем точную ошибку Telegram API
                Log::error('❌ Telegram SEND ERROR. CHECK TOKEN/FIREWALL.', [
                    'error' => $e->getMessage(),
                    'chat_id' => $chatId,
                ]);
            }
        } else {
             // Логируем, если пришло не сообщение (например, callback)
             Log::warning('⚠️ Update received but no message ID found.');
        }

        // Всегда возвращаем HTTP 200 OK для Telegram
        return response()->json(['status' => 'ok', 'message' => 'Processed update']);
    }
}