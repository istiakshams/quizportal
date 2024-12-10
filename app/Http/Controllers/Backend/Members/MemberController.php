<?php

namespace App\Http\Controllers\Backend\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\MemberStoreRequest;

class MemberController extends Controller
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
     */
    public function index()
    {
        $users = User::with("roles")
        ->whereHas("roles", function($q) {
            $q->whereIn("name", ["Member"]);
        })
        ->get();
        // dd($users);
        return view('backend.members.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function admins()
    {
        $users = User::with("roles")
        ->whereHas("roles", function($q) {
            $q->whereIn("name", ["Admin"]);
        })
        ->get();
        // dd($users);
        return view('backend.members.index', compact('users'));       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('backend.members.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = Hash::make($request['password']);
        // dd($attributes);

        // Create new user
        $user = User::create($attributes);

        // Assign role
        $role = $attributes['role'];
        if( isset($role) ) {
            $user->roles()->sync($role);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->back()->with('message', 'New member added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
