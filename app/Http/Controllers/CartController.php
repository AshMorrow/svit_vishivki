<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Helpers\Options;

class CartController extends Controller
{

    public function show(Request $request)
    {
        if (isset($_COOKIE['productInCart']) && $_COOKIE['productInCart']) {

            $products = (array)json_decode($_COOKIE['productInCart'])->products;
            $order_products_ids = array_keys($products);

            $order_products_all_data = DB::table('products AS p')
                ->select('p.*')
                ->whereIn('p.id', $order_products_ids)
                ->where('p.is_active', '=', 1)
                ->get();

            $total_price = 0;
            $options = '';
            foreach ($order_products_all_data as $data) {
                foreach ($products as $id => $product){
                    if($id == $data->id){
                        $data->personalValues = $product->personalValues;
                        foreach ($product->personalValues as $value){
                            $total_price += $value->quantity * $data->price;
                            $options .= implode(',', $value->characteristics);
                            $options .= ',';
                        }
                    }
                }
            }
        }


        return view('pages.fullCart',
            [
                'products_for_order' => $order_products_all_data ?? null,
                'options' => Options::getValues($options?? null),
                'total_price' => $total_price ?? null,
                'lan' => App::getLocale()
            ]);

    }

    public function create_order(Request $request)
    {
        // validating user order data
        $this->validate($request, [
            "first_name" => "required|min:2",
            "last_name" => "required|min:2",
            "email" => "required|email",
            "phone" => "required",
            "delivery_type" => "required|integer",
        ]);

        // Checking delivery type
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

        // Preparing product data
        $products = json_decode($_COOKIE['productInCart'])->products;
        $products_id = array_keys((array)$products);
        $products_price_db = DB::table('products AS p')
            ->select('p.id', 'p.price')
            ->whereIn('id', $products_id)
            ->get()
            ->toArray();

        $products_price = [];
        foreach ($products_price_db as $product){
            $products_price[$product->id] = $product->price;
        }

        foreach ($products as $id => $product){

        }

        $lastInsertId = DB::table('orders')->insertGetId([
            'name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'delivery_type' => $request->input('delivery_type'),
            'delivery_address' => $request->input('delivery_address') ?? '',
            'n_post_city' => $request->input('n_post_city') ?? '',
            'n_post_office' => $request->input('n_post_office') ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $query = [];
        $total_price = 0;

        foreach ($products as $id => $product) {
            foreach ($product->personalValues as $value){
                $query[] = [
                    'order_id' => $lastInsertId,
                    'product_id' => $id,
                    'quantity' => $value->quantity,
                    'options' => implode(',',$value->characteristics),
                    'price_per_one' => $products_price[$id]
                ];
                $total_price += $value->quantity * $products_price[$id];
            }
        }

        DB::table('order_products')->insert($query);
        DB::table('orders')->where('id', $lastInsertId)->update(['total_price' => $total_price]);

    }

}
