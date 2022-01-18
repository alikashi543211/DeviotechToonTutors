<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\MeetingSession;
use Illuminate\Http\Request;
use App\Models\User;

class SessionHistoryController extends Controller
{
    public function history()
    {
        $sessions = MeetingSession::where('student_id', auth()->user()->id)->get();
        return view('parent.session.history', get_defined_vars());
    }

    public function refund(Request $request)
	{
        $admin = User::where('role','admin')->first()->email;
		$m_session = MeetingSession::where('session_id',$request->session_id)->first();
		$m_session->refund_request = 2;
		$m_session->save();
		sendMail([
			'view' => 'emails.parent.refund_request',
			'subject' => $request->subject,
			'to' => $admin,
			'data' => [
				'zoom_id' => $request->session_id,
				'description' =>$request->message
			]
		]);

		return redirect()->back()->with('success', 'Request is  send Succesfully');
	}
}
