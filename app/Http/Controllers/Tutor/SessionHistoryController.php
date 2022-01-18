<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingSession;

class SessionHistoryController extends Controller
{
    public function history()
    {
        $sessions = MeetingSession::where('tutor_id', auth()->user()->id)->get();
        return view('tutor.session.history', get_defined_vars());
    }

    public function delete($id = null)
    {
        MeetingSession::find($id)->delete();
        return redirect()->back()->with('success', 'Session Deleted Successfully!');
    }
}
