<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MomentController extends Controller
{
    public function getIndex()
    {
        return view('moments.index');
    }
}
