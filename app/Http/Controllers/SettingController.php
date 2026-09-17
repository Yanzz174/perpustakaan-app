<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate([], [
            'site_name' => 'Perpustakaan Digital',
            'fine_per_day' => 1000,
            'max_borrow_days' => 7,
        ]);

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'site_name' => 'required|string|max:255',
            'fine_per_day' => 'required|numeric|min:0',
            'max_borrow_days' => 'required|integer|min:1',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $data = [
            'site_name' => $request->site_name,
            'fine_per_day' => $request->fine_per_day,
            'max_borrow_days' => $request->max_borrow_days,
        ];

        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo) {
                Storage::disk('public')->delete($setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Pengaturan web berhasil diperbarui.');
    }
}
