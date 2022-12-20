<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class SelectTypeConversation extends Conversation
{
  
    public function askType()
    {
        $question = Question::create('Bạn đang cần tư vấn về vấn đề gì?')
            ->callbackId('select_service')
            ->addButtons([
                Button::create('Gym')->value('Gym'),
                Button::create('Yoga')->value('Yoga'),
                Button::create('Chế Độ Ăn')->value('Diet'),
                Button::create('Triathlon')->value('Triathlon'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'service' => $answer->getValue(),
                ]);

                $this->bot->startConversation(new ResponseConversation());
            }
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askType();
    }
}