<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return UserResource::collection($users);
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
            'name'     => 'required|string|max:100',
            'email'    => 'required|unique:users|email|max:100',
            'role_id'  => 'required|integer|exists:user_roles,id',
            'password' => 'required|string|max:100',
            'image'    => 'image|mimes:png,jpg,jpeg,svg,gif|max:1000',
        ]);

        $data = $request->all();
        $data['password'] = \Hash::make($data['password']);
        
        $user = User::create($data);

        if($request->hasFile('image'))
        {
            $user->image = $request->image->hashName();
            $request->image->storeAs('accounts', $user->image , 'public');
        }

        $user->save();

        return (new UserResource($user));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return (new UserResource($user));
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
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email,' . $id,
            'role_id'  => 'required|integer|exists:user_roles,id',
            'password' => 'required|string|max:100',
            'image'    => 'image|mimes:png,jpg,jpeg,svg,gif|max:1000',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();

        $data['password'] = \Hash::make($data['password']);

        $user->update($data);

        if($request->hasFile('image'))
        {
            $user->image = $request->image->hashName();
            $request->image->storeAs('accounts', $user->image , 'public');
        }

        $user->save();

        return (new UserResource($user));
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

        return response()->json([
            'message' => 'User deleted'
        ]);
    }
}
