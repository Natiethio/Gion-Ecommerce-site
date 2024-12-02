<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function handle(Request $request)
    {
        $update = Telegram::commandsHandler(true);

        // Get the message sent to the bot
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $text = $message->getText();

        // Basic command to start user registration
        if ($text == '/start') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Welcome! Please send your email to register.',
            ]);
        } else if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
            // Save the email (user data) to the database
            // Assuming you have a User model and migration already set up
            $user = \App\Models\User::create([
                'email' => $text,
                'name' => 'Default Name', // You can ask for name later if needed
            ]);

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Thank you! You are registered.',
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Please enter a valid email address.',
            ]);
        }

        return response('OK', 200);
    }
}
