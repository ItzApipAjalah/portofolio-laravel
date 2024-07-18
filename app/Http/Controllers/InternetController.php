<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternetController extends Controller
{
    public function noInternet()
    {
        return view('no-internet');
    }
}
