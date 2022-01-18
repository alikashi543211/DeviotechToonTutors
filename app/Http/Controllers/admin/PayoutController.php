<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorPayout;

class PayoutController extends Controller
{
    public function payouts()
    {
        $payouts = TutorPayout::all();
        return view('admin.payout.list', get_defined_vars());
    }

    public function delete($id = null)
    {
    	$payout = TutorPayout::find($id)->delete();
    	return back()->with("success","Deleted successfully");
    }
}
