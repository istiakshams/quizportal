<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
    /**
     * Show module settings page
     */
    public function index()
    {
        
        $module_subscription = Module::isEnabled('Subscription') ? true : false;
        $module_newsletter = Module::isEnabled('Newsletter') ? true : false;
        $module_support = Module::isEnabled('Support') ? true : false;
        $module_affiliate = Module::isEnabled('Affiliate') ? true : false;
        return view('backend.modules.index', compact('module_subscription', 'module_newsletter', 'module_support', 'module_affiliate'));
    }

    /**
     * Update module settings
     */
    public function update(Request $request)
    {
        $attributes = $this->validate(request(), [
            'module_subscription' => '',
            'module_newsletter' => '',
            'module_support' => '',
            'module_affiliate' => '',
        ]);
        // dd($attributes);
          
        // Module Subscription
        if( isset($attributes['module_subscription']) != null ) {        
            Module::enable('Subscription');
        }
        else {
            Module::disable('Subscription');
        }
        
        // Module Newsletter
        if( isset($attributes['module_newsletter']) != null ) {        
            Module::enable('Newsletter');
        }
        else {
            Module::disable('Newsletter');
        }
          
        // Module Support
        if( isset($attributes['module_support']) != null ) {        
            Module::enable('Support');
        }
        else {
            Module::disable('Support');
        }
        
        // Module Affiliate
        if( isset($attributes['module_affiliate']) != null ) {        
            Module::enable('Affiliate');
        }
        else {
            Module::disable('Affiliate');
        }

        return redirect()->back()->with('message', 'Module settings updated successfully!');    
    }


}
