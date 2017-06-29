<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getProduct(Request $request){

        dd($request->cookie('productInCart'));

    }

}
