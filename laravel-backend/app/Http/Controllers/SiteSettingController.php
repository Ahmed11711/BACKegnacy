<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSetting\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Get all site settings
     */
    public function index(Request $request): JsonResponse
    {
        $group = $request->get('group');
        
        if ($group) {
            $settings = SiteSetting::getByGroup($group);
        } else {
            $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        }

        return response()->json([
            'data' => $settings,
        ]);
    }

    /**
     * Update site settings
     */
    public function update(UpdateSiteSettingRequest $request): JsonResponse
    {
        foreach ($request->settings as $setting) {
            SiteSetting::setValue(
                $setting['key'],
                $setting['value'] ?? null,
                $setting['type'] ?? 'text',
                $setting['group'] ?? 'general'
            );
        }

        return response()->json([
            'message' => 'Settings updated successfully',
        ]);
    }

    /**
     * Get setting by key
     */
    public function show(string $key): JsonResponse
    {
        $setting = SiteSetting::where('key', $key)->first();

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }

        return response()->json([
            'data' => [
                'key' => $setting->key,
                'value' => $setting->value,
                'type' => $setting->type,
                'group' => $setting->group,
            ],
        ]);
    }
}
