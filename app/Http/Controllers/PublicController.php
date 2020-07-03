<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PublicController extends Controller
{
    public function welcomePage()
    {
        return view('pages.home');
        return view('public.welcome');
    }

    public function dataProtection()
    {
        return view('public.data_protection');
    }

    public function lang(Request $request, $lang)
    {
        App::setlocale($lang);
        return view('public.welcome');
    }
}
