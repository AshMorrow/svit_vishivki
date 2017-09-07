<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function show(Request $request)
    {
        if (isset($_COOKIE['productInCart']) && $_COOKIE['productInCart']) {

            $order_products_json = json_decode($_COOKIE['productInCart'])->items;

            $order_products = [];
            $quantity = [];
            foreach ($order_products_json as $product) {
                $order_products[] = $product->id;
                $quantity[] = $product->quantity;
            }

            $order_products_all_data = DB::table('products AS p')
                ->select('p.*')
                ->whereIn('p.id', $order_products)
                ->where('p.is_active', '=', 1)
                ->get()->toArray();

            $sort_by_add = [];
            $total_price = 0;
            foreach ($order_products as $key => $id) {
                foreach ($order_products_all_data as $data) {
                    if ($id == $data->id) {
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

    public function create_order(Request $request)
    {

        $this->validate($request, [
            "first_name" => "required|min:2",
            "last_name" => "required|min:2",
            "email" => "required|email",
            "phone" => "required",
            "delivery_type" => "required|integer",
        ]);

        switch ($request->input('delivery_type')) {
            case 2:
                $this->validate($request, [
                    'delivery_address' => 'required',
                ]);
                break;
            case 3:
                $this->validate($request, [
                    'n_post_city' => 'required',
                    'n_post_office' => 'required',
                ]);
        }

        $lastInsertId = DB::table('orders')->insertGetId([
            'name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'delivery_type' => $request->input('delivery_type'),
            'delivery_address' => $request->input('delivery_address')?? '',
            'n_post_city' => $request->input('n_post_city')?? '',
            'n_post_office' => $request->input('n_post_office')?? ''
        ]);

        $order_products_json = json_decode($_COOKIE['productInCart'])->items;
        $query = [];
        
        foreach ($order_products_json as $product) {
            $query[] = [
                'order_id' => $lastInsertId,
                'product_id' => $product->id,
                'quantity' => $product->quantity,
            ];
        }

        DB::table('order_products')->insert($query);
    }

}
