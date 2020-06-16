<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    
    public function change($locale)
    {
        \Session::put('locale', $locale);

        return back();
    }
}
