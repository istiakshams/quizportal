<?php

namespace App\Http\Controllers\Backend\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Language;
use App\Models\Localization;
use Cache;

class LanguageController extends Controller
{
    
    // Display language settings page
    public function index(Request $request)
    {
        $searchKey = null;
        $languages = Language::oldest();
        if( $request->search != null ) {
            $languages = $languages->where('name', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        $languages = $languages->get();                
        return view('backend.systemsettings.language-settings', compact('languages', 'searchKey'));
    }


    // Add New Language
    public function store(Request $request)
    {
        if (Language::where('code', $request->code)->first()) {                    
            return redirect()->back()->with('error', 'This code is already used for another language!');
        }

        $language = new Language;
        $language->name = $request->name;
        $language->flag = $request->flag;
        $language->code = $request->code;
        $language->is_rtl = $request->is_rtl;
        $language->save();

        Cache::forget('languages');
                
        return redirect()->back()->with('message', 'Language has been added successfully!');
    }

    // Edit language
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('backend.systemSettings.language-edit', compact('language'));
    }


    // Update language
    public function update(Request $request)
    {
        $checkLanguage = Language::where('code', $request->code)->first();
        $language = Language::findOrFail($request->id);

        if (
            $checkLanguage &&
            $checkLanguage->id != $language->id
        ) {
            return redirect()->back()->with('error', 'This code is already used for another language!');
        }

        if ($language->id != 1) {
            $language->code = $request->code;
        }

        $language->name = $request->name;
        $language->flag = $request->flag;
        $language->is_rtl = $request->is_rtl;

        $language->save();

        Cache::forget('languages');
        
        return redirect()->back()->with('message', 'Language has been updated successfully!');
    }

    // Set default language 
    public function defaultLanguage(Request $request)
    {                
        $attributes = $this->validate(request(), [
            'default_language' => 'required',
        ]);

        // Deactivate all languages
        Language::query()->update(['is_active' => 0]);

        // Set active language
        $language = Language::where('code', $attributes['default_language'])->first();
        $language->is_active = 1;
        $language->save();

        writeToEnvFile('DEFAULT_LANGUAGE', $attributes['default_language']);

        return redirect()->back()->with('message', 'Default language updated successfully!');
    }

    // Update language status 
    public function updateStatus(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $activatedLanguages = Language::where('is_active', 1)->count();

        if( env('DEFAULT_LANGUAGE') == $language->code && $request->is_active == 0 ) {
            return [
                'status'    => false,
                'message'    => localize('Default language can not be disabled'),
            ];
        } 
        elseif( $activatedLanguages <= 1 && $request->is_active == 0 ) {
            return [
                'status'    => false,
                'message'    => localize('Minimum 1 language need to be enabled'),
            ];
        }

        $language->is_active = $request->is_active;
        if( $language->save() ) {
            return [
                'status'    => true,
                'message'    => localize('Status updated successfully'),
            ];
        }

        return [
            'status'    => false,
            'message'    => localize('Something went wrong'),
        ];
    }
    
    # Update template language status 
    public function updateTemplateStatus(Request $request)
    {
        $language = Language::findOrFail($request->id);  
        $language->is_active_for_templates = $request->is_active_for_templates;

        if ($language->save()) {
            return [
                'status'    => true,
                'message'    => localize('Status updated successfully'),
            ];
        } 
        return [
            'status'    => false,
            'message'    => localize('Something went wrong'),
        ];
    }
    
    
    // Show localizations
    public function showLocalizations(Request $request, $id)
    {
        $searchKey = null;
        $language = Language::findOrFail($id);
        $localizations = Localization::where('lang_key', 'en');
        if ($request->has('search')) {
            $searchKey = $request->search;
            $localizations = $localizations->where('t_value', 'like', '%' . $searchKey . '%');
        }
        $localizations = $localizations->paginate(150);

        // dd($language);
            // foreach ($localizations as $key => $localization) {

            //     $localization_lang = Localization::where('lang_key', $language->code)
            //                             ->where('t_key', $localization->t_key)
            //                             ->latest()
            //                             ->first();
            //                             dd($localization_lang);
            // }


        return view('backend.systemSettings.language-localizations', compact('language', 'localizations', 'searchKey'));
    }

    // Save localizations
    public function storeLocalizations(Request $request)
    {
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $localization = Localization::where('t_key', $key)->where('lang_key', $language->code)->latest()->first();
            if ($localization == null) {
                $localization = new Localization;
                $localization->lang_key = $language->code;
                $localization->t_key = $key;
                $localization->t_value = $value ? $value : '';
                $localization->save();
            } else {
                $localization->t_value = $value ? $value : '';
                $localization->save();
            }
        }
        Cache::forget('localizations-' . $language->code);

        flash(localize('Localizations have been updated'))->success();
        return back();
    }

}
