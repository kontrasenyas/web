<?php
namespace App\Http\Controllers;

use App\Message;
use App\MessageReply;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class MessageController extends Controller
{
	public function getIndex($user_id)
	{
        if (Auth::user()->id != $user_id) {
            return redirect()->route('home');
        }
        else {
            $message_replies = MessageReply::where('user_id', $user_id)->orderBy('created_at', 'asc')->first();

            $list = DB::table('messages as m')
            ->join('message_reply as mr',function($join){
                 $join->on('m.id','=','mr.message_id');
            })
            ->join('users as u',function($join){
                 $join->on('u.id','=','m.user_one')
                 ->orOn('u.id','=','m.user_two'); 
            })
            ->where(function($query) use($user_id){
                $query->where('m.user_one','=',$user_id);
                $query->orWhere('m.user_two','=',$user_id);
            })
            ->where(function($query) use($user_id){
                $query->whereRaw(DB::raw(
                       'CASE WHEN m.user_one = '.$user_id.
                       ' THEN m.user_two = u.id'. 
                       ' WHEN m.user_two = '.$user_id.
                       ' THEN m.user_one = u.id END'));
               })            
            ->select('u.*', 'm.*', 'mr.reply', 'mr.created_at', 'mr.message_id', 'mr.user_id as latest_user_reply', 'mr.created_at as mr_created')
            ->orderBy('mr.created_at','desc')
            ->limit('20')
            ->get()
            ->unique('message_id');

    		return view('messages.index', ['list' => $list]);
        }
	}

    public function getMessage($user_id)
    {
        $sent_to = User::where('id', $user_id)->first();
        $sent_from = User::where('id', Auth::user()->id)->first();

        $message = Message::where('user_one', $sent_from->id)
                        ->where('user_two', $sent_to->id);
                        
        $message2 = Message::where('user_two', $sent_from->id)
                        ->where('user_one', $sent_to->id)
                        ->union($message)
                        ->first();

        $message_reply_union = new MessageReply();
        $message_reply = new MessageReply();

        if (count($message2) != 0) {
            $message_reply_union = MessageReply::where('user_id', $sent_to->id)
                                           ->where('message_id', $message2->id);

            $message_reply = MessageReply::where('user_id', $sent_from->id)
                                        ->where('message_id', $message2->id)                           
                                        ->union($message_reply_union)
                                        ->orderBy('created_at', 'asc')
                                        ->get();
        }
       
        return view('messages.inbox', ['sent_to' => $sent_to, 'sent_from' => $sent_from, 'message' => $message2, 'message_reply' => $message_reply]);
    }

    public function postMessage(Request $request, $sent_to)
    {
        $sent_from = Auth::user()->id;
        $sent_to = $request['sent_to'];
        $reply = $request['reply'];

        $first = Message::where('user_one', $sent_to)
                            ->where('user_two', $sent_from);

        $validate = Message::where('user_one', $sent_from)
                            ->where('user_two', $sent_to)
                            ->union($first)
                            ->first();

        $message = new Message();

        if ($validate === NULL) {
            $message->user_one = $sent_from;
            $message->user_two = $sent_to;

            $message->save();

            $first = Message::where('user_one', $sent_to)
                            ->where('user_two', $sent_from);

            $validate = Message::where('user_one', $sent_from)
                                ->where('user_two', $sent_to)
                                ->union($first)
                                ->first();
        }

        if ($validate != NULL) {      
            if ($validate->user_one == Auth::user()->id) {
                $sent_from = $validate->user_one;
                $messages = Message::where('user_one', $sent_from)
                                ->where('user_two', $sent_to)
                                ->orderBy('id', 'desc')
                                ->first();
            }
            else {
                $sent_from = $validate->user_two;
                $messages = Message::where('user_two', $sent_from)
                                ->where('user_one', $sent_to)
                                ->orderBy('id', 'desc')
                                ->first();
            }
        }

        $message_reply = new MessageReply();

        $message_reply->reply = $reply;
        $message_reply->user_id = $sent_from;
        $message_reply->message_id = $messages->id;

        $message_reply->save();

        return redirect()->back();
    }
}