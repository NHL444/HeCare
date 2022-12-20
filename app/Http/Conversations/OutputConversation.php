<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OutputConversation extends Conversation
{
  
    public function askIssue()
    {
        $question = Question::create('Bạn Sẽ?')
            ->callbackId('select_issue')
            ->addButtons([
                Button::create('Tiếp tục đặt Câu Hỏi?')->value('TT'),
                Button::create('Đến Mô Hình Tư Vấn')->value('MH'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'issue' => $answer->getValue(),
                ]);
            }
            $this->Choose();
        });
    }
    public function Choose(){

        $user = $this->bot->userStorage()->find();
        if($user->get('issue')=='TT'){
            $this->handle();
        }
       else{
        $this->startConversation(new SelectTypeConversation);
        }
        
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askIssue();
    }
}