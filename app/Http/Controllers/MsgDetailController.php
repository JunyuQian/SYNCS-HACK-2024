<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MsgDetailController extends Controller
{
    public function index($id)
    {
        return view('msgDetail');
    }
}
