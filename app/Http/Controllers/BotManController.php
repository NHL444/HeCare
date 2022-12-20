<?php
namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Http\Conversations\OutputConversation;
use App\Http\Conversations\SelectTypeConversation;
use App\Models\Chatbot;
use App\Models\ChatbotAdvice;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Auth;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

   
        $botman->hears('{keyword}', function ($bot, $keyword) {
            $answer = \App\Models\Chatbot::where('intent_greet', 'LIKE', $keyword)->get();
            $type = \App\Models\Chatbot::where('intent_model', 'LIKE',"%{$keyword}%")->get();
            $other = \App\Models\Chatbot::where('intent_other', 'LIKE',"%{$keyword}%")->get();
            
            if(count($answer)>0){
                $bot->startConversation(new OnboardingConversation);
            }else if(count($other)>0){
                $bot->reply($other[0]->reply_intent);
            }else if(count($type)>0){
                    $bot->startConversation(new SelectTypeConversation);
            }else{
                    $bot->reply('Không hiểu ý bạn, tiếp tục đặt câu hỏi hoặc gõ "hi" để vào mô hình tư vấn!');
            }

        });
        
        $botman->listen();
    }
   

    public function index()
    {
        $adminname= Auth::guard('admin')->user();
        $greet = Chatbot::where('intent_greet','!=',NULL)->get();
        $type = Chatbot::where('intent_model','!=',NULL)->get();
        $other= Chatbot::where('intent_other','!=',NULL)->get();
        return view('admin.chatbot.add-key',[
             'user'=>$adminname,
             'greet'=>$greet,
             'type'=>$type,
             'other'=>$other,
           
        ]);
       
    }
    public function editModel(Request $request){
        $key_id = $request->key_id;
        $new_name = $request->new_name;
        $key = Chatbot::find($key_id);
        $key->intent_model = $new_name;
        $key->save();
    }
    public function editGreet(Request $request){
        $key_id = $request->key_id;
        $new_name = $request->new_name;
        $key = Chatbot::find($key_id);
        $key->intent_greet = $new_name;
        $key->save();
    }
    public function saveKey(Request $request){
        $request->validate([
            'keyword' => 'required|unique:chatbot_advices',
        ], [
            'required' => 'Từ khóa bắt buộc phải nhập',
            'keyword.unique' => "Từ khóa đã tồn tại"
        ]);
        $bot = new ChatbotAdvice();
        $bot->keyword = $request->keyword; 
        $bot->reply = $request->reply; 
        $bot->parent = $request->choose; 
        $bot->save();
        return redirect()->back()->with('success','Đã Tạo Thành Công');

    }
    public function editkeyOther($id){
        $adminname= Auth::guard('admin')->user();
        $edit = Chatbot::find($id);
        return view('admin.chatbot.edit',[
            'user'=>$adminname,
            'edit'=>$edit,
          
       ]);
    }
    public function editkeyModel($id){
        $adminname= Auth::guard('admin')->user();
        $model = ChatbotAdvice::find($id);
        return view('admin.chatbot.edit',[
            'user'=>$adminname,
            'model'=>$model,
          
       ]);
    }
    public function savekeyOther(Request $request,$id){
        $key= Chatbot::find($id);
        $key->intent_other =$request ->keyword;
        $key->reply_intent =$request ->reply;
        $key->update();
        return redirect('/chatbot')->with('success','Đã cập nhật thành công');

    }
    public function savekeyModel(Request $request,$id){
        $key= ChatbotAdvice::find($id);
        $key->keyword =$request ->keyword;
        $key->reply =$request ->reply;
        $key->parent =$request ->choose;
        $key->update();
        return redirect('/chatbot/manage-key')->with('success','Đã cập nhật thành công');

    }
    public function savekeyUser(Request $request){
        $request->validate([
            'keyword' => 'required|unique:chatbot_advices',
            'choose' => 'required'
        ], [
            'required' => 'Trường bắt buộc phải nhập',
            'keyword.unique' => "Từ khóa đã tồn tại"
        ]);
        $bot = new Chatbot();
        if($request->choose==1){
            $bot->intent_greet = $request->keyword; 
            $bot->save();
        }else if($request->choose==2){
            $bot->intent_model = $request->keyword;  
            $bot->save();
        }elseif($request->choose==3){
            $bot->intent_other = $request->keyword; 
            $bot->reply_intent = $request->reply; 
            $bot->save();
        }
        return redirect()->back()->with('success','Tạo Từ Khóa Mới Thành Công');

    }
    public function manage(){
        $adminname= Auth::guard('admin')->user();
        $all = ChatbotAdvice::all();
       
        return view('admin.chatbot.manage',[
             'user'=>$adminname,
             'all'=>$all
        ]);

    }
    public function delKey($id)
    {
        $del=ChatbotAdvice::find($id);
        $del->delete();
        return redirect()->back()->with('success','Đã Xóa Từ Khóa!');
    }
}
   

