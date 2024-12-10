<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display Profile page.
     */
    public function index()
    {
        $user = Auth::user();

        return view(getThemePath() . '.profile.index', compact('user'));
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {        
        $attributes = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);                
        // dd($attributes);

        $user = Auth::user();
        $user->name = $attributes['name'];

        $tempuser = User::where('email', $attributes['email'])->first();
        // dd($tempuser->email);

        if( $tempuser && $tempuser->email != $user->email ) {
            return redirect()->back()->with('error', 'A member with the email already exists!');    
        }

        $user->email = $attributes['email'];
        $user->save();

        return redirect()->back()->with('message', 'Profile updated successfully!');    
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {        
        $attributes = $this->validate(request(), [
            // 'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'repeat_password' => 'required|string|min:8',
        ]);            
        // $pass = Hash::make($attributes['current_password']);
        // dd($pass);
        // dd($attributes);
        $user = Auth::user();

        if( $attributes['new_password'] != $attributes['repeat_password'] ) {
            return redirect()->back()->with('error', 'Password do not match!');    
        }
        // else if( $user->password != Hash::make($attributes['current_password']) ) {
        //     return redirect()->back()->with('error', 'Current password does not match!');   
        // }
        else {
            $user->password = Hash::make($attributes['new_password']);
            $user->save();
            return redirect()->back()->with('message', 'Profile updated successfully!');    
        }
    }
}
