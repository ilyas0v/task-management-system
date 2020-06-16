<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  =  \Cache::remember('users', 10 , function(){
            return \App\User::with('role')->get();
        });

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \App\UserRole::all();
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required|max:100|string',
            'email' => 'required|max:100|string|email',
            'password' => 'required|max:100|string',
            'role_id' => 'required|integer|exists:user_roles,id',
        ]);

        $fields = $request->all();

        $fields['password'] = \Hash::make($fields['password']);

        $user = \App\User::create($fields);

        \Session::flash('success_message' , 'User created');
        return redirect()->route('users.index');
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
        $user = \App\User::findOrFail($id);
        $roles = \App\UserRole::all();

        return view('admin.users.edit', compact('user', 'roles'));
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
        $this->validate($request, [
            'name' => 'required|max:100|string',
            'email' => 'required|max:100|string|email',
            'role_id' => 'required|integer|exists:user_roles,id',
        ]);

        $user = \App\User::findOrFail($id); // SELECT * FROM users WHERE id = $id

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;


        if(!empty($request->password))
        {
            $this->validate($request , [
                'password' => 'max:100|string',
            ]);

            $user->password = \Hash::make($request->password);
        }


        $user->save();

        \Session::flash('success_message' , 'User updated');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();

        \Session::flash('success_message' , 'User deleted');
        return redirect()->route('users.index');
    }




    public function test()
    {
        $user_list = \Cache::remember('user_list_test', 10 ,  function(){

            $roles = \App\UserRole::all();
    
            $user_list = [];
    
            foreach($roles as $role)
            {
                $user = \App\User::where('role_id', $role->id)->first();
                $user_list[] = $user;
            }

            return $user_list;
        });


        return $user_list;
    }
}
