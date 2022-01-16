<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a settings for Twitter account
     */
    public function index()
    {
        // Get data from database
        $settings = Setting::all();

        return view('settings', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $settingValue = $request->input('setting_value');

        // Set value from form and save
        $setting->value = $settingValue;
        $setting->save();

        return redirect('settings');
    }
}
