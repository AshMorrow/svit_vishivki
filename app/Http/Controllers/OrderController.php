<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class OrderController extends Controller
{

    public function validateCustomerDara(Request $request)
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
    }

    public function create(Request $request)
    {

        // validating user order data
        $this->validateCustomerDara($request);

        // Preparing product data
        $products = json_decode($_COOKIE['productInCart'])->products;
        $products_id = array_keys((array)$products);
        $products_price_db = DB::table('products AS p')
            ->select('p.id', 'p.price')
            ->whereIn('id', $products_id)
            ->get()
            ->toArray();

        $products_price = [];
        foreach ($products_price_db as $product) {
            $products_price[$product->id] = $product->price;
        }

        /**
         * Writing order information to DB
         * and getting order id
         */
        $lastInsertId = DB::table('orders')->insertGetId([
            'name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'comment' => $request->input('comment'),
            'delivery_type' => $request->input('delivery_type'),
            'delivery_address' => $request->input('delivery_address') ?? '',
            'n_post_city' => $request->input('n_post_city') ?? '',
            'n_post_office' => $request->input('n_post_office') ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $query = []; // will be include query with order products
        $total_price = 0;

        /**
         * Creating query with order product
         * and calculating total order price
         */
        foreach ($products as $id => $product) {
            foreach ($product->personalValues as $value) {
                $query[] = [
                    'order_id' => $lastInsertId,
                    'product_id' => $id,
                    'quantity' => $value->quantity,
                    'options' => implode(',', $value->characteristics),
                    'price_per_one' => $products_price[$id],
                    'uniqueKey' => uniqid('', true)
                ];
                $total_price += $value->quantity * $products_price[$id];
            }
        }

        DB::table('order_products')->insert($query);
        DB::table('orders')->where('id', $lastInsertId)->update(['total_price' => $total_price]);

        setcookie('productInCart', '', -1, '/');

        return redirect('/order-created');


    }

    public function success(Request $request){
        return view('pages.orderCreated');
    }


}
