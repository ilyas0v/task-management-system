<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class GmailLoginController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        $user = Socialite::driver('google')->user();

        $email = $user['email'];

        $user_from_db = User::where('email', $email)->first();

        //return $user_from_db;

        if($user_from_db)
        {

            \Auth::login($user_from_db);
            return redirect()->route('dashboard.index');

        } else {

            // $name = $user['name'];

            // $avatar = $user->avatar;

            // $image = $this->download_image($avatar);

            // $new_user      = new User();
            // $new_user->name    = $name;
            // $new_user->email   = $email;
            // $new_user->role_id = 1; 
            // $new_user->password = \Hash::make(time());
            // $new_user->image = $image;

            // $new_user->save();

            // \Auth::login($new_user);
            // return redirect()->route('dashboard.index');

            return '<h1>Your account doesnt exist</h1>';
        }
    }


    public function download_image($url)
    {
        $content = file_get_contents($url);

        $filename = time() . rand(1,1000) . '.png';

        \Storage::disk('public')->put('accounts/' . $filename , $content);
        
        return $filename;

    }

}
