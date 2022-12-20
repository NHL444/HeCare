<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class DietConversation extends Conversation
{
    public function askWeight()
    {
        $question = Question::create('Cân Nặng Hiện Tại Của Bạn?')
            ->callbackId('select_weight')
            ->addButtons([
                Button::create('<=45kg')->value('<=45kg'),
                Button::create('<=55kg')->value('<=55kg'),
                Button::create('<=65kg')->value('<=65kg'),
                Button::create('<=75kg')->value('<=75kg'),
                Button::create('>75kg')->value('>75kg'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'weight' => $answer->getValue(),
                ]);
            }
            $this->askHeight();
        });
    }
    //2,4 2,56 2,89 3,06 3,24
    public function askHeight()
    {
        $question = Question::create('Chiều Cao Hiện Tại Của Bạn?')
            ->callbackId('select_height')
            ->addButtons([
                Button::create('<=155cm')->value('<=155cm'),
                Button::create('<=160cm')->value('<=160cm'),
                Button::create('<=167cm')->value('<=167cm'),
                Button::create('<=175cm')->value('<=175cm'),
                Button::create('>175cm')->value('>175cm'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'height' => $answer->getValue(),
                ]);
            }
            $this->askIssue();
        });
    }
    public function askIssue()
    {
        $question = Question::create('Bạn Đang Muốn Xây Dựng Chế Độ Ăn Theo?')
            ->callbackId('select_issue')
            ->addButtons([
                Button::create('Chế Độ Giảm Cân')->value('GC'),
                Button::create('Chế Độ Tăng Cân')->value('TC'),
                Button::create('Cho Lời Khuyên')->value('LK'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'issue' => $answer->getValue(),
                ]);
            }
            $this->Diet();
        });
    }
    public function Diet(){

        $user = $this->bot->userStorage()->find();
       
        if($user->get('issue')=='GC'){
            $question = Question::create('Tìm Hiểu Bí Quyết Giảm Cân')
            ->callbackId('select_diet')
            ->addButtons([
                Button::create('Thực đơn Cắt Đường')->value('cda_gc_catduong'),
                Button::create('Thực đơn Paleo')->value('cda_gc_paleo'),
                Button::create('Thực đơn Vegan')->value('cda_gc_vegan'),
                Button::create('Thực đơn LowCarb')->value('cda_gc_lowcarb'),
                Button::create('Thực đơn Dukan')->value('cda_gc_dukan'),
                Button::create('Chọn bộ môn khác')->value('stop'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'diet' => $answer->getValue(),
                    ]);
                }
            $this->getMenu();
        });

        }elseif($user->get('issue')=='TC'){
            $question = Question::create('Thực Đơn Giảm Cân Cho Người Gầy')
            ->callbackId('select_issue')
            ->addButtons([
                Button::create('Thực đơn 1')->value('cda_tc_td1'),
                Button::create('Thực đơn 2')->value('cda_tc_td2'),
                Button::create('Thực đơn 3')->value('cda_tc_td3'),
                Button::create('Thực đơn 4')->value('cda_tc_td4'),
                Button::create('Chọn bộ môn khác')->value('stop'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->bot->userStorage()->save([
                        'diet' => $answer->getValue(),
                    ]);
                }
                $this->getMenu();
        });
        }elseif(($user->get('issue')=='LK')  && (($user->get('weight')=='<=45kg')
                                                ||(($user->get('weight')=='<=55kg') && ($user->get('height')=='<=175cm'||'>175cm'))))
            { 
                $message = '-------------------------------------- <br>';
                $message .= 'Do bạn cao '.$user->get('height'). ' nhưng chỉ nặng ở mức '.$user->get('weight').'<br>';
                $message .= 'Kết Luận: BMI dưới ngưỡng, => Gầy, Nên Tăng Cân' . '<br>';
                $message .= '---------------------------------------';

                $this->say('Lời khuyên: '.$message);
                $this->askIssue();
  
        }elseif(($user->get('issue')=='LK')  && (($user->get('weight')=='>75kg')
                                                ||(($user->get('weight')=='<=75kg') && ($user->get('height')=='<=175cm'||'>175cm'))
                                                ||(($user->get('weight')=='<=65kg') && ($user->get('height')=='<=155cm'||'<=160cm')))
            ){
    
                $message = '-------------------------------------- <br>';
                $message .= 'Do bạn nặng tới '.$user->get('weight').' và cao '.$user->get('height').'<br>';
                $message .= 'Kết Luận: BMI vượt ngưỡng => Béo, Nên Giảm Cân' . '<br>';
                $message .= '---------------------------------------';

                $this->say('Lời khuyên: '.$message);
                $this->askIssue();
        }elseif(($user->get('issue')=='LK')  && ((($user->get('weight')=='<=55kg') && ($user->get('height')=='<=155cm'||'<=160cm'||'<=167cm'))
                                                ||(($user->get('weight')=='<=65kg') && ($user->get('height')=='<=167cm'||'<=175cm'||'>175cm'))
                                                ||(($user->get('weight')=='<=75kg') && ($user->get('height')=='<=155cm'||'<=160cm'||'<=167cm')))
            ){
                $message = '-------------------------------------- <br>';
                $message .= 'Do bạn nặng '.$user->get('weight').' và cao '.$user->get('height').'<br>';
                $message .= 'Kết Luận: BMI cân đối, Ăn Uống Bình Thường' . '<br>';
                $message .= '---------------------------------------';

                $this->say('Lời khuyên: '.$message);
                $this->askIssue();


        }
        

    }
    public function getMenu(){

        $user = $this->bot->userStorage()->find();
        $answer = \App\Models\ChatbotAdvice::where('keyword', 'LIKE', $user->get('diet'))->get();
        if(count($answer)>0){
            $this->say($answer[0]->reply);
            $this->askIssue();
        }
        elseif($user->get('diet')=='stop'){
            $this->bot->startConversation(new SelectTypeConversation());
        }
        

    }

    public function run()
    {
        $this->askWeight();
    }
}