<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class YogaConversation extends Conversation
{
  
    public function askIssue()
    {
        $question = Question::create('Bạn Đang Quan Tâm Về?')
            ->callbackId('select_issue')
            ->addButtons([
                Button::create('Cách ăn uống')->value('yoga_cachan'),
                Button::create('Các bài tập luyện')->value('yoga_cdtap'),
                Button::create('Chọn bộ môn khác')->value('stop'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'issue' => $answer->getValue(),
                ]);
            }
            $this->Yoga();
        });
    }
    public function Yoga(){

        $user = $this->bot->userStorage()->find();
        $answer = \App\Models\ChatbotAdvice::where('keyword', 'LIKE', $user->get('issue'))->get();
        if(count($answer)>0){
            $this->say($answer[0]->reply);
            $this->askIssue();
        }
        elseif($user->get('issue')=='stop'){
            $this->bot->startConversation(new SelectTypeConversation());
        }

        

    }
    public function run()
    {
        $this->askIssue();
    }
}