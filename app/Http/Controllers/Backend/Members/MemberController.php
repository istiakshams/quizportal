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
        $role = 'All';
        return view('backend.members.index', compact('users', 'role'));
    }

    /**
     * Display a listing of the resource.
     */
    public function list($role = 'Member')
    {
        $role = ucfirst($role);
        $rolesArr = array($role);
        $users = User::with("roles")
        ->whereHas("roles", function($q) use ($rolesArr) {
            $q->whereIn("name", $rolesArr);
        })
        ->get();
        // dd($users);
        return view('backend.members.index', compact('users', 'role'));
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
        $roles = Role::get();
        $user = User::findOrFail($id);
        return view('backend.members.edit', compact('user', 'roles'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $attributes = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => '',
            'password' => '',
            'role' => 'required',
        ]);
        // dd($attributes);

        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'];
        if( $attributes['password'] != null ) {
            $user->password = Hash::make($attributes['password']);
        }
        $user->save();

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
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'Member deleted successfully!');
    }
}
