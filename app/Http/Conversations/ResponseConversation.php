<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ResponseConversation extends Conversation
{
    public function responseType()
    {
        $user = $this->bot->userStorage()->find();

        if($user->get('service')=='Gym'){
            $this->bot->startConversation(new GymConversation());
        }else if($user->get('service')=='Yoga'){
            $this->bot->startConversation(new YogaConversation());
        }else if($user->get('service')=='Diet'){
            $this->bot->startConversation(new DietConversation());
        }

        // $message = '-------------------------------------- <br>';
        // $message .= 'Name : ' . $user->get('name') . '<br>';
        // $message .= 'Email : ' . $user->get('email') . '<br>';
        // $message .= 'Mobile : ' . $user->get('mobile') . '<br>';
        // $message .= 'Service : ' . $user->get('service') . '<br>';
        // $message .= 'Date : ' . $user->get('date') . '<br>';
        // $message .= 'Time : ' . $user->get('timeSlot') . '<br>';
        // $message .= '---------------------------------------';

        // $this->say('Great. Your booking has been confirmed. Here is your booking details. <br><br>' . $message);
    }

    public function run()
    {
        $this->responseType();
    }
}