<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
    {
        $update = $request->all(); // Берём весь update

        Log::info('Telegram update:', $update); // Логируем входящие сообщения

        // Проверяем, что пришло сообщение
        if (isset($update['message']['chat']['id'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? '';

            // Шаблон ответа
            $replyText = "Вы написали: \"$text\"\nСпасибо, что пишете!";

            try {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $replyText
                ]);
            } catch (\Exception $e) {
                Log::error('Telegram sendMessage error: ' . $e->getMessage());
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
