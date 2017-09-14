<?php

namespace App\Http\Controllers;

use App\Helpers\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrdersController extends Controller
{
    public function getOrdersList(Request $request){

        $orderBy = $request->orderBy ?? 'created_at';
        $orders = DB::table('orders')->select('*')->orderBy($orderBy, 'desc')->paginate(15);

        return view('admin.ordersList', ['orders' => $orders]);
    }

    public function orderDetails(Request $request, $id){

        $order = DB::table('orders AS o')
            ->leftJoin('order_products AS op', 'op.order_id', 'o.id')
            ->select('*')
            ->where('o.id', '=', $id)
            ->get()
            ->toArray();

        $optionIds = '';
        foreach ($order as $product){
            $optionIds .= $product->options.',';
        }

        $options = (Options::getValues($optionIds));

        return view('admin.orderDetails', ['orderData' => $order, 'options' => $options]);

    }
}
