<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    

    public function edit()
    {
        $user = \Auth::user();
        return view('admin.account.edit', compact('user'));
    }



    public function update(Request $request)
    {

        $user = \Auth::user();


        $this->validate($request, [
            'name'    => 'required|max:30|string',
            'email'   => 'sometimes|required|unique:users,email,' . $user->id,
            'image'   => 'required|image|mimes:png,jpeg,jpg,svg,gif'
        ]);

        
        
        $user->name  = $request->name;
        $user->email = $request->email;
        
        if($request->hasFile('image'))
        {
            $user->image = $request->image->hashName();
            $request->image->storeAs('accounts', $user->image, 'public');
        }

        $user->save();

        return back();
    }
}
