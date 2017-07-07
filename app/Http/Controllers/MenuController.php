<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function make_tree($data){

    }

    public function get_main_menu(){
        $menu_data = DB::table('main_menu')->get()->toArray();
        dd($menu_data);
    }
}
