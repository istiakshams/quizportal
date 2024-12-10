<?php

namespace App\Http\Controllers\Backend\Appearance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FooterSettingsStoreRequest;

use App\Models\ThemeSettings;

class ThemeSettingsController extends Controller
{
    /**
     * Display Theme Settings Page
     */
    public function showThemeSettings()
    {
        return view('backend.appearance.theme-settings');
    }

    /**
     * Update Theme Settings
     */
    public function updateThemeSetting(Request $request)
    {
        $attributes = $this->validate(request(), [
            'theme_name' => 'required',
        ]);
        // dd($attributes);

        ThemeSettings::set('theme_name', $attributes['theme_name']);
        return redirect()->back()->with('message', 'New theme activated successfully!');
    }

    /**
     * Display Header Settings Page
     */
    public function showHeaderSettings()
    {

        $site_logo_light = ThemeSettings::get('site_logo_light');
        $site_logo_dark = ThemeSettings::get('site_logo_dark');

        return view('backend.appearance.header-settings', compact('site_logo_light', 'site_logo_dark'));
    }

    /**
     * Update Header Settings
     */
    public function updateeHeaderSetting()
    {
        $attributes = $this->validate(request(), [
            'site_logo_light' => 'required',
            'site_logo_dark' => 'required',
        ]);
        // dd($attributes);

        ThemeSettings::set('site_logo_light', $attributes['site_logo_light']);
        ThemeSettings::set('site_logo_dark', $attributes['site_logo_dark']);
        return redirect()->back()->with('message', 'Header settings saved successfully!');
    }

    /**
     * Display Footer Settings Page
     */
    public function showFooterSettings()
    {                
        $copyright_text = ThemeSettings::get('copyright_text');

        return view('backend.appearance.footer-settings', compact('copyright_text'));
    }

    /**
     * Save Footer Settings
     */
    public function updateFooterSetting(FooterSettingsStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);

        ThemeSettings::set('footer_logo', $attributes['footer_logo']);
        ThemeSettings::set('footer_about_us', $attributes['footer_about_us']);
        ThemeSettings::set('footer_newsletter', $attributes['footer_newsletter']);
        ThemeSettings::set('copyright_text', $attributes['copyright_text']);
        return redirect()->back()->with('message', 'Footer settings saved successfully!');
    }
}
