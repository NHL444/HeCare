<?php

namespace App\Conversations;

use App\Http\Conversations\SelectTypeConversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OnboardingConversation extends Conversation
{

    public function askName()
    {
        $this->ask('Chào quý khách, hãy cho tôi biết tên của bạn là gi?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'name' => $answer->getText(),
            ]);

            $this->say('Rất vui được biết, '.$answer->getText());
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('Hãy cho tôi biết Email của bạn là gì?', function (Answer $answer) {
            $validator = Validator::make(['email' => $answer->getText()], [
                'email' => 'email',
            ]);

            if ($validator->fails()) {
                return $this->repeat('Đây không phải định dạng Email, vui lòng nhập lại');
            }

            $this->bot->userStorage()->save([
                'email' => $answer->getText(),
            ]);

            $this->askGender();
        });
    }
    public function askGender()
    {
        
        $this->ask('Giới tính của bạn là gì (nam/nu)?', function(Answer $answer) {
            $this->bot->userStorage()->save([
                'gender' => $answer->getText(),
            ]);

            $this->say('Đây là thông tin mà tôi cần từ bạn.');
            $this->bot->startConversation(new SelectTypeConversation());
        });       
    }
   
//     public function askNextStep()
//     {
//         $this->ask('Shall we proceed? Say YES or NO', [
//             [
//                 'pattern' => 'yes|yep',
//                 'callback' => function () {
//                     $this->say('Okay - we\'ll keep going');
//                     $this->askButton();
//                 }
//             ],
//             [
//                 'pattern' => 'nah|no|nope',
//                 'callback' => function () {
//                     $this->say('PANIC!! Stop the engines NOW!');
//                     $this->askButton();
//                 }
//             ]
            
//         ]);
        
//     }
//     public function askButton()
//     {
//         $question = Question::create('Do you agree with me?')
//         ->callbackId('agree')
//         ->addButtons([
//             Button::create('Yes')->value('yes'),
//             Button::create('No')->value('no'),
//         ]);
    
//         $this->ask($question, function(Answer $answer) {
//             $this->askTest();
    
//     });
        
//     }
//     public function askTest()
//     {
//         $this->ask('Giới tính của bạn là gì (nam/nu)?', function(Answer $answer) {
//             // Save result
//             $this->test = $answer->getText();

//             $this->say('Great - that is all we need, '.$this->firstname);
//         });
//     }
//     public function askmail()
// {
//     $this->ask('What is your email?', function(Answer $answer) {

//         $validator = Validator::make(['email' => $answer->getText()], [
//             'email' => 'email',
//         ]);

//         if ($validator->fails()) {
//             return $this->repeat('That doesn\'t look like a valid email. Please enter a valid email.');
//         }

//         $this->bot->userStorage()->save([
//             'email' => $answer->getText(),
//         ]);

//         $this->askMobile();
//     });
// }
      
// public function askTown()
// {
//     $slug = str_slug($this->town, '-');
//     $question = Question::create("If you have questions about $this->town, please visit their community page here:")
//         ->fallback('Unable to ask question')
//         ->callbackId('ask_reason')
//         ->addButtons([
//             Button::create('Visit Link: /city/'.$slug)->value('visit'),
//             Button::create('Ask Something Else')->value('continue')
//         ]);

//     return $this->ask($question, function (Answer $answer) {
//         if ($answer->isInteractiveMessageReply()) {
//             if ($answer->getValue() === 'visit') {
//                 $this->say('Glad I could help!');
//             } else {
//                 $this->say('Alright, lets talk about something else.');
//             }
//         }
//     });
// }

    public function run()
    {
        // This will be called immediately
        $this->askName();
    }
}