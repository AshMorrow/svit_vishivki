<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App;

class ShopController extends Controller
{

    protected function getProductsForSlider(){
        $products = DB::table('products')
            ->select('name_'.App::getLocale(), 'price', 'id', 'is_new', 'is_popular', 'url')
            ->where([
                ['is_new', '=', 1],
                ['is_active', '=', 1]
            ])
            ->orWhere([
                ['is_popular', '=', 1],
                ['is_active', '=', 1]
            ])
            ->get()->toArray();

        return $products;
    }

    public function main(){

        $products = $this->getProductsForSlider();

        return view('pages.mainPage', ['products' => $products, 'name' => 'name_'.App::getLocale()]);

    }
}
