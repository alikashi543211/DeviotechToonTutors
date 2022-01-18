<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function cmsSetting()
    {
        $setting = Setting::pluck('setting', 'name');
        return view('admin.setting.cms',get_defined_vars());
    }
    public function webSetting()
    {
        $setting = Setting::pluck('setting', 'name');
        return view('admin.setting.website',get_defined_vars());
    }
    public function cmsStore(Request $request)
    {
        $setting = $request->except('_token');
        foreach ($setting as $key => $value) {
            if (empty($value))
                continue;
            $set = Setting::where('name', $key)->first() ?: new Setting();
            $set->name = $key;
            $set->setting = $value;
            $set->save();
        }
        return redirect()->back()->with('message','The setting is created successfully');
    }
}
