<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function A(){
        // Keets noi CSDL
        return view('auth.hoc-ky', ['data' => 'DemoController say helooooo']);
    }
}
