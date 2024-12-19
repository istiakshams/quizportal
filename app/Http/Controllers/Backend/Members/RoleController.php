<?php

namespace App\Http\Controllers\Backend\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

// Importing laravel-permission Models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class RoleController extends Controller
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
        $roles = Role::all();
        $permissions = Permission::all();

        return view('backend.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('backend.roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|unique:roles|max:10',
          'permissions' => 'required',
        ]);

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();

        foreach( $permissions as $permission ) {
          $p = Permission::where('id', '=', $permission)->firstOrFail();

          // Fetch the newly created role and assign permissions
          $role = Role::where('name', '=', $name)->first();
          $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')->with('message', 'Role ' . $role->name .' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('backend.roles.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);

        $this->validate($request, [
          'name' => 'required|max:10',
          'permissions' => 'required',
        ]);

        // $input = $request->except(['permissions']);
        $input['name'] = $request['name'];
        $permissions = $request['permissions'];
        //dd($input);
        $role->update($input);

        $p_all = Permission::all();

        foreach( $p_all as $p ) {
          $role->revokePermissionTo($p);
        }

        foreach( $permissions as $permission ) {
          $p = Permission::where('id', '=', $permission)->firstOrFail();
          $role->givePermissionTo($p);
        }

        return redirect()->back()->with('message', 'Role ' . $role->name .' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('message', 'Role deleted!');
    }
}
