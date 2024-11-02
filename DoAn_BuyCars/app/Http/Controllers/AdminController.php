<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // return view('admin');
        return redirect()->route('detail_admin');

    }
    public function detail_admin()
    {
        return view('detail_admin');
    }
}
