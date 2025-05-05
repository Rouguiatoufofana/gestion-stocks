<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProffesseurController extends Controller
{
    public function index()
    {
        return view('administration.pages.proffesseurs.index');
    }
}

