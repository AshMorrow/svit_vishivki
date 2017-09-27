<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Showing main page of Admin panel
    public function mainPage(){

        return view('admin.main');
    }
}
