<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorRequest;

class RequestController extends Controller
{
    public function request()
    {
        $one_time = TutorRequest::where('interval',1)->get();
        $recurring = TutorRequest::where('interval',2)->get();
        return view('admin.request.requests', get_defined_vars());
    }

    public function delete($id = null)
    {
        TutorRequest::find($id)->delete();

    	return back()->with("success","Deleted successfully");
    }
}
