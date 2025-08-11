<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('settings.index', compact('setting'));
    }

    public function edit()
    {
        $setting = Setting::first() ?? new Setting();
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'store_name' => 'nullable|string',
            'currency' => 'nullable|string',
            'tax_percentage' => 'nullable|numeric',
            'store_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('store_logo')) {
            $path = $request->file('store_logo')->store('logos', 'public');
            $data['store_logo'] = $path;
        }

        $setting->fill($data)->save();

        return redirect()->back()->with('success', 'تم تحديث الإعدادات بنجاح');
    }
}
