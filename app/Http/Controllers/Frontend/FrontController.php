<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ContactUsRequest;

use App\Models\User;
use App\Models\Page;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class FrontController extends Controller
{
    /**
     * Display Home page.
     */
    public function showHomePage()
    {
        $page = Page::where('slug', 'home-page')->firstOrFail();
        return view(getThemePath() . '.pages.default.home', compact('page'));
    }

    /**
     * Display Contact Us page.
     */
    public function showContactUs()
    {
        $page = Page::where('slug', 'contact-us')->firstOrFail();
        return view(getThemePath() . '.pages.default.contactus', compact('page'));
    }

    /**
     * Display About Us page.
     */
    public function showAboutUs()
    {
        $page = Page::where('slug', 'about-us')->firstOrFail();
        return view(getThemePath() . '.pages.default.aboutus', compact('page'));
    }

    /**
     * Display Privacy Policy page.
     */
    public function showPrivacyPolicy()
    {
        $page = Page::where('slug', 'privacy-policy')->firstOrFail();
        return view(getThemePath() . '.pages.index', compact('page'));
    }

    /**
     * Display Terms And Conditions page.
     */
    public function showTOS()
    {
        $page = Page::where('slug', 'terms-and-conditions')->firstOrFail();
        return view(getThemePath() . '.pages.index', compact('page'));
    }

    /**
     * Display a page based on slug.
     */
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->first();
        // dd($page);

        if( $page && $page->status == 'published' ) {
            return view(getThemePath() . '.pages.index', compact('page'));
        }
        else { 
            return view(getThemePath() . '.errors.404');
        }
    }

    /**
     * Send Contact Us Message
     */
    public function sendContactUs(ContactUsRequest $request)
    {
        // $attributes = $request->validated();

        // // Send Email Report
        // Mail::to(getSetting('contact_email'))->send(new ContactUsMail($attributes['name'], $attributes['email'], $attributes['message']));
                
        // return redirect()->back()->with('message', 'Your message was sent successfully!');
    }

    /**
     * Send Contact Us Message - AJAX
     */
    public function sendContactUsAjax(ContactUsRequest $request)
    {
                
        $attributes = $request->validated();

        // Send Email
        Mail::to(getSetting('contact_email'))->send(new ContactUsMail($attributes['name'], $attributes['email'], $attributes['msg']));

        return response()->json(['message'=>'Your message was sent successfully!']);


        // $attributes = $request->all();
        // dd($attributes);

        // if($attributes->fails())
        // {
                    
            // return response()->json(['message'=>'Error!']);
        // }
        // else {
            // Send Email Report
            // Mail::to(getSetting('contact_email'))->send(new ContactUsMail($attributes['name'], $attributes['email'], $attributes['message']));
            
    //   }
    }
}
