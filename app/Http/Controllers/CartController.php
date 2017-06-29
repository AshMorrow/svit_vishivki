<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function show(Request $request){
        if(isset($_COOKIE['productInCart']) && $_COOKIE['productInCart']){

            $order_products_json = json_decode($_COOKIE['productInCart'])->items;

            $order_products = [];
            $quantity = [];
            foreach ($order_products_json as $product){
                $order_products[] = $product->id;
                $quantity[] = $product->quantity;
            }

            $order_products_all_data = DB::table('products AS p')
                ->leftJoin('product_colors AS pc', 'pc.p_id', '=', 'p.id')
                ->leftJoin('available_colors AS ac', 'ac.id', '=', 'pc.ac_id')
                ->select('p.*','pc.*','p.id AS id')
                ->whereIn('p.id', $order_products)
                ->where('p.is_active', '=', 1)
                ->get()->toArray();

            $sort_by_add = [];
            $total_price = 0;
            foreach ($order_products as $key => $id){
                foreach ($order_products_all_data as $data){
                    if($id == $data->id){
                        $data->quantity = $quantity[$key];
                        $sort_by_add[] = $data;
                        $total_price += $quantity[$key] * $data->price;
                    }
                }
            }

        }
        return view('pages.fullCart',
            [
                'products_for_order' => $sort_by_add ?? null,
                'total_price' => $total_price ?? null
            ]);

    }

    public function create_order(){
        dd($_POST);
    }

}
