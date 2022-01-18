<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ParentController extends Controller
{
    public function parentList()
    {
    	$list = User::where('role','parent')->get();
        return view('admin.parent.list', get_defined_vars());
    }

    public function delete($id=null)
    {
    	$user = User::find($id)->delete();
    	return back()->with("success","Deleted successfully");
    }
}
