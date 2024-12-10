<?php

namespace App\Http\Controllers\Backend\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Mail\NewMemberEmail;
use Illuminate\Support\Facades\Mail;

use App\Models\User;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.members.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
            'payment' => '',
            'transactionid' => '',
            'role' => 'required',
        ]);
        $attributes['password'] = Hash::make($request['password']);
        // dd($attributes);

        $user = User::create($attributes);

        $role = $request['role'];
        if (isset($role)) {
            $user->roles()->sync($role);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->back()->with('message', 'New member added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::get();
        //dd($roles);

        $user = User::findOrFail($id);
        return view('admin.members.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $attributes = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'paymentstatus' => '',
            'paymenttype' => '',
            'paymentphone' => '',
            'transactionid' => '',
            'role' => 'required',
        ]);
        // dd($attributes);

        $user->update($attributes);

        $role = $request['role'];
        if (isset($role)) {
            $user->roles()->sync($role);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->back()->with('message', 'Member details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'Member deleted successfully!');
    }

    
    /**
     * Email login details to user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendemail($id)
    {
        $user = User::findOrFail($id);
        // dd($user->email);

        // USE A DEFULT PASSWORD FIRST TIME LOGIN
        $password = 'abcdef123';

        // The email sending is done using the to method on the Mail facade
        Mail::to($user->email)->send(new NewMemberEmail($user->name, $user->email, $password));

        return redirect()->back()->with('message', 'Login details sent to member successfully!');        
    }
}
