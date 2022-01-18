<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class StudentController extends Controller
{
    public function studentList()
    {
        $list=User::where('role','student')->get();
        return view('admin.student.list',get_defined_vars());
    }

    public function delete($id=null)
    {
    	$user=User::find($id);
    	$user->student_profile->delete();
    	$user->delete();
    	return back()->with("success","Deleted successfully");
    }
}
