<?php

namespace App\Http\Controllers\Backend\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

// Importing laravel-permission Models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        $roles = Role::get();

        return view('backend.permissions.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('backend.permissions.create')->with('roles', $roles);
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
          'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;
        $permission->save();

        $roles = $request['roles'];

        if(!empty($request['roles'])) {
          foreach($roles as $role) {
            $r = Role::where('id', '=', $role)->firstOrFail();

            $permission = Permission::where('name', '=', $name)->first();
            $r->givePermissionTo($permission);
          }
        }

        return redirect()->back()->with('message', 'Permission ' . $permission->name. ' added!');
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
        $permission = Permission::findOrFail($id);
        $roles = Role::get();

        
        return view('backend.permissions.edit', compact('permission', 'roles'));
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
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
          'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission->name = $name;
        $permission->save();

        $roles = $request['roles'];

        if(!empty($request['roles'])) {
          foreach($roles as $role) {
            $r = Role::where('id', '=', $role)->firstOrFail();

            $permission = Permission::where('name', '=', $name)->first();
            $r->givePermissionTo($permission);
          }
        }

        return redirect()->back()->with('message', 'Permission ' . $permission->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if($permission->name == "Browse Admin") {
          return redirect()->route('/admin/members/permissions')
            ->with('flash_message', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->back()->with('message', 'Permission deleted!');
    }
}
