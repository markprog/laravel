<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
     public function webhook(Request $request)
    {
        $update = Telegram::getWebhookUpdates();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        // Простейший ответ
        Telegram::sendMessage([
            'chat_id' => 6415801830,
            'text' => "Вы написали: $text"
        ]);

        return response()->json(['status' => 'ok']);

        
}

}
