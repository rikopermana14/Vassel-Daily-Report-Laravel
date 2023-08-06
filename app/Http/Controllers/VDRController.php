<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VDRController extends Controller
{
    public function vdr()
    {
        return view('vdr.index');
    }
}
