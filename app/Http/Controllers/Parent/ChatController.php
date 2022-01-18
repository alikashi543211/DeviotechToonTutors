<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\TutorRequest;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function chat()
    {
        $converstaions = Conversation::where('student_id', auth()->user()->id)->get();
        return view('parent.chat', get_defined_vars());
    }

    public function studentContacts(Request $req)
    {
        $converstaions = Conversation::where('student_id', auth()->user()->id)
            ->whereHas('tutor_user', function($q) use($req){
                $q->where('name', 'like', "%$req->q%");
            })->with('tutor_user')->limit(100)->get();

        return view('ajax.parent.contacts', get_defined_vars());
    }

    public function getChat(Request $req)
    {
        $user = auth()->user();
        $list = Conversation::find($req->id);
        return view('ajax.parent.chat', get_defined_vars());
    }

    public function saveMessage(Request $req)
	{
		$user = auth()->user();

        $m = new Message();
        $m->conversation_id = $req->convo_id;
		$m->user_id = $user->id;
		$m->message = $req->message;
		$m->ip = $req->ip();
        $m->save();

		return response()->json('OK');
	}
}
