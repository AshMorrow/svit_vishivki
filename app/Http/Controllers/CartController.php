<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{

    private function getOptions($optionsIds){
        if(!$optionsIds && is_string($optionsIds)) return;

        $options = DB::table('characteristics AS c')
            ->select(DB::raw('
                c.name_ru,
                c.name_ua, 
                c.type,
                GROUP_CONCAT(DISTINCT cv.id) AS char_values_id, 
                GROUP_CONCAT(DISTINCT cv.value) AS char_values')
            )
            ->leftJoin('characteristic_value AS cv', 'cv.c_id', '=', 'c.id')
            ->whereIn('cv.id',explode(',', $optionsIds))
            ->groupBy('c.id')
            ->get()->toArray();
        return $options;
    }

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
                'options' => $this->getOptions($options?? null),
                'total_price' => $total_price ?? null,
                'lan' => App::getLocale()
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
            'delivery_address' => $request->input('delivery_address') ?? '',
            'n_post_city' => $request->input('n_post_city') ?? '',
            'n_post_office' => $request->input('n_post_office') ?? ''
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
