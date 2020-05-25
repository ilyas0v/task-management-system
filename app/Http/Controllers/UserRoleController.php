<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_roles = \App\UserRole::all();
        return view('admin.user_roles.index', compact('user_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = \App\Permission::all();
        return view('admin.user_roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|max:200',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $r = new \App\UserRole();

        $r->name = $request->name;

        $r->save();

        $r->permissions()->attach($request->permissions);

        \Session::flash('success_message' , 'Role created');
        return redirect()->route('user_roles.index');
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
        $role = \App\UserRole::findOrFail($id);

        $permissions = \App\Permission::all();

        return view('admin.user_roles.edit', compact('role', 'permissions'));
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
        $this->validate($request , [
            'name' => 'required|max:200',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $r = \App\UserRole::findOrFail($id);

        $r->name = $request->name;

        $r->save();

        $r->permissions()->sync($request->permissions);

        \Session::flash('success_message' , 'Role updated');
        return redirect()->route('user_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = \App\UserRole::findOrFail($id);

        $role->delete();

        \Session::flash('success_message' , 'Role deleted');
        return redirect()->route('user_roles.index');
    }
}
