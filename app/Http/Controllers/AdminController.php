<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Showing main page of Admin panel
    public function main_page(){

        return view('admin.main');
    }
}
