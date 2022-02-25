<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenucController extends Controller
{
    public function index() 
    {
        return view('menu');
    }
}
