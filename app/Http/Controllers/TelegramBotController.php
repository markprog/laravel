<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
    {
        $update = $request->all(); // Берём весь update от Telegram

        // Логируем update, чтобы видеть структуру и chat_id
        Log::info('Telegram update received:', $update);

        // Проверяем, есть ли chat.id
        if (isset($update['message']['chat']['id'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? '';

            // Простейший шаблон ответа
            $replyText = "Вы написали: \"$text\"\nСпасибо за сообщение!";

            try {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $replyText
                ]);
            } catch (\Exception $e) {
                Log::error('Telegram sendMessage error: ' . $e->getMessage());
            }
        } else {
            Log::warning('Update does not contain chat id.', $update);
        }

        return response()->json(['status' => 'ok']);
    }
}
