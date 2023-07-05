<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageListingsController extends Controller
{
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
