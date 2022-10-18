<?php

namespace App\TelegramHandlers;

use Illuminate\Support\Str;
use WeStacks\TeleBot\Handlers\UpdateHandler;
use WeStacks\TeleBot\Objects\Update;

class MessageHandler extends UpdateHandler
{

    public function trigger(): bool
    {
        return isset($this->update->message) && $this->update->is('message');
    }

    public function handle()
    {
        if(Str::contains(strtolower($this->update->message), ['github.com/spatie', 'spatie.be', 'freek.dev'])) {
            $this->sendPhoto([
                'chat_id' => $this->update->chat()->id,
                'photo' => fopen(resource_path('img/spatie.jpg'), 'r'),
                'reply_to_message_id' => $this->update->message->message_id,
            ]);
        }
    }
}
