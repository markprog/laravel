<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
    {
        $update = $request->all(); // Берём весь JSON от Telegram

        Log::info('Telegram update:', $update); // Логируем для проверки

        if (isset($update['message']['chat']['id'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? '';

            // Простейший ответ
            try {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Вы написали: $text"
                ]);
            } catch (\Exception $e) {
                Log::error('Telegram sendMessage error: ' . $e->getMessage());
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
