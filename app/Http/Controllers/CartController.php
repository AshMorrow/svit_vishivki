<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Helpers\Options;
use Symfony\Component\Routing\Annotation\Route;

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
                foreach ($products as $id => $product) {
                    if ($id == $data->id) {
                        $data->personalValues = $product->personalValues;
                        foreach ($product->personalValues as $value) {
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
                'options' => Options::getValues($options ?? null),
                'total_price' => $total_price ?? null,
                'lan' => App::getLocale()
            ]);

    }


}
