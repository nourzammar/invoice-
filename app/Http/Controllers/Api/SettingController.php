<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Transformers\SettingTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        return SettingTransformer::transform($setting);
    }
    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();
        return SettingTransformer::transform($setting);
    }
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'required'
        ]);
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();
        return SettingTransformer::transform($setting);
    }
    public function delete(Setting $setting)
    {
        $setting->delete();
        return response()->json('done!', 200);
    }
}
