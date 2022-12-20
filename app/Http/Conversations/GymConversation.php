<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class GymConversation extends Conversation
{
    public function askIssue()
    {
        $question = Question::create('Bạn Đang Quan Tâm Về?')
            ->callbackId('select_issue')
            ->addButtons([
                Button::create('Xây dựng thực đơn')->value('TD'),
                Button::create('Chế độ tập luyện')->value('TL'),
                
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'issue' => $answer->getValue(),
                ]);
            }
            $this->askStyle();
        });
    }
    public function askStyle(){
        $question = Question::create('Hãy chọn xu hướng tập!')
            ->callbackId('select_style')
            ->addButtons([
                Button::create('Tập tăng cơ - giảm mỡ')->value('tangco'),
                Button::create('Giảm cân')->value('giamcan'),
                Button::create('Chọn bộ môn khác')->value('stop'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'style' => $answer->getValue(),
                ]);
            }
            $this->choosePlan();
        });
    }
    
    public function choosePlan(){
        $user = $this->bot->userStorage()->find();

        if($user->get('issue')=='TD' && ($user->get('style')=='tangco')){
            $question = Question::create('Hãy chọn thực đơn')
            ->callbackId('select_plan')
            ->addButtons([
                Button::create('Chia nhiều bữa nhỏ')->value('gym_chianhobuaan'),
                Button::create('Giàu Protein')->value('gym_giauprotein'),
                Button::create('Phát triển cơ bắp')->value('gym_phatco'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'plan' => $answer->getValue(),
                    ]);
                }
            $this->getAdvice();
        });
        }elseif($user->get('issue')=='TD' && ($user->get('style')=='giamcan')){
            $question = Question::create('Hãy chọn thực đơn')
            ->callbackId('select_plan')
            ->addButtons([
                Button::create('Trước khi tập')->value('gym_gc_truoc'),
                Button::create('Sau khi tập')->value('gym_gc_sau'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'plan' => $answer->getValue(),
                    ]);
                }
            $this->getAdvice();
        });
        }elseif($user->get('issue')=='TL' && ($user->get('style')=='giamcan')){
            $question = Question::create('Bạn dự định sẽ tập ở?')
            ->callbackId('select_plan')
            ->addButtons([
                Button::create('Tại Nhà')->value('gym_gc_tainha'),
                Button::create('Phòng tập')->value('gym_gc_taiphong'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'plan' => $answer->getValue(),
                    ]);
                }
            $this->getAdvice();
        });
        }elseif($user->get('issue')=='TL' && ($user->get('style')=='tangco')){
            $question = Question::create('Bạn dự định sẽ tập ở?')
            ->callbackId('select_plan')
            ->addButtons([
                Button::create('Tại Nhà')->value('gym_taptainha'),
                Button::create('Phòng tập')->value('gym_taiphongtap'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'plan' => $answer->getValue(),
                    ]);
                }
            $this->getAdvice();
        });
        }elseif($user->get('style')=='stop'){
            $this->bot->startConversation(new SelectTypeConversation());
        }
    }
    public function getAdvice(){

        $user = $this->bot->userStorage()->find();
        $answer = \App\Models\ChatbotAdvice::where('keyword', 'LIKE', $user->get('plan'))->get();
        if(count($answer)>0){
            $this->say($answer[0]->reply);
            $this->askIssue();
        }

       elseif($user->get('plan')=='gym_taiphongtap'){
            $question = Question::create('Chọn lịch tập!')
            ->callbackId('select_session')
            ->addButtons([
                Button::create('Lịch Năm Buổi')->value('gym_taiphong5buoi'),
                Button::create('Lịch Sáu Buổi')->value('gym_taiphong6buoi'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'session' => $answer->getValue(),
                    ]);
                }
            $this->numberSession();
        });
        }
        
    }
    public function numberSession(){
        $user = $this->bot->userStorage()->find();
        $answer = \App\Models\ChatbotAdvice::where('keyword', 'LIKE', $user->get('session'))->get();
        if(count($answer)>0){
            $this->say($answer[0]->reply);
            $this->askIssue();
        }
        

    }

    public function run()
    {
        $this->askIssue();
    }
}