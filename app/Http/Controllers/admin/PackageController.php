<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Package;

class PackageController extends Controller
{
	public function list()
	{
		$packages = Package::all();
		return view('admin.package.list', get_defined_vars());
	}

	public function add()
	{
		return view('admin.package.add');
	}

	public function edit($id = null)
	{
		$package = Package::find($id);
		return view('admin.package.edit', get_defined_vars());
	}

	public function save(Request $request, $id = null)
	{
		$request->validate([
		    'name' => 'required',
		    'hours' => 'required|numeric|min:1',
		    'per_hour_amount' => 'required|numeric|min:1',
		    'total_amount' => 'required|numeric',
        ]);
        if (is_null($id)) {
            $package = Package::create([
                'name' => $request->name,
                'hours' => $request->hours,
                'per_hour_amount' => $request->per_hour_amount,
                'total_amount' => $request->total_amount,
                'description' => $request->description ?? null,
            ]);
        } else {
            $package = Package::find($id)->update([
                'name' => $request->name,
                'hours' => $request->hours,
                'per_hour_amount' => $request->per_hour_amount,
                'total_amount' => $request->total_amount,
                'description' => $request->description ?? null,
            ]);
        }

	    return redirect()->route('admin.packages.list')->with('success', 'Package has been updated successfully!');
	}

	public function delete($id = null)
	{
		$package = Package::find($id)->delete();
		return redirect()->back()->with('success', 'Package has been deleted successfully!');
	}
}
