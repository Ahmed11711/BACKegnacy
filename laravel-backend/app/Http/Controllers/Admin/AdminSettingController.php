<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable',
            'settings.*.file' => 'nullable|image|max:5120',
            'settings.*.type' => 'nullable|string|in:text,textarea,image,json,boolean',
            'settings.*.group' => 'nullable|string',
        ]);

        foreach ($request->settings as $key => $setting) {
            $value = $setting['value'] ?? null;
            
            // Handle file upload for image type
            if ($setting['type'] === 'image' && $request->hasFile("settings.{$key}.file")) {
                $file = $request->file("settings.{$key}.file");
                $fileService = app(\App\Services\FileUploadService::class);
                $value = $fileService->uploadImage($file, 'settings');
            }
            
            SiteSetting::setValue(
                $setting['key'],
                $value,
                $setting['type'] ?? 'text',
                $setting['group'] ?? 'general'
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
}
