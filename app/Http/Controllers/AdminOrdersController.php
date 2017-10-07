<?php

namespace App\Http\Controllers;

use App\Helpers\Options;
use App\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminOrdersController extends Controller
{
    public function getOrdersList(Request $request)
    {

        $orderBy = $request->orderBy ?? 'created_at';
        $orders = DB::table('orders')->select('*')->orderBy($orderBy, 'desc')->paginate(10);

        return view('admin.ordersList', ['orders' => $orders]);
    }

    public function orderDetails(Request $request, $id)
    {

        $order = DB::table('orders AS o')
            ->leftJoin('order_products AS op', 'op.order_id', 'o.id')
            ->select('*')
            ->where('o.id', '=', $id)
            ->get()
            ->toArray();

        $optionIds = '';
        foreach ($order as $product) {
            $optionIds .= $product->options . ',';
        }

        $options = (Options::getValues($optionIds, true));

        return view('admin.orderDetails', ['orderData' => $order, 'options' => $options]);
    }

    public function adminOrderForm(Request $request)
    {
        $this->validate($request, [
            "id" => "required|min:1",
            "name" => "required|min:2",
            "lastName" => "required|min:2",
            "email" => "required|email",
            "phone" => "required",
            "delivery_type" => "required|integer",
            "status" => "required|integer"
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

    function updateOrder(Request $request)
    {

        $this->adminOrderForm($request);

        $products = json_decode($request->input('products'));
        if (empty((array)$products)) {
           return redirect()->back();
        }

        $id = $request->input('id');
        $query = [];
        $total_price = 0;

        foreach ($products as $key => $product) {
            $query[] = [
                'order_id' => $id,
                'product_id' => $product->id,
                'quantity' => $product->quantity,
                'options' => $product->options,
                'price_per_one' => $product->price,
                'uniqueKey' => $key
            ];
            $total_price += $product->quantity * $product->price;
        }

        DB::table('orders')
            ->where('id', '=', $id)
            ->update([
                'name' => $request->input('name'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'comment' => $request->input('comment'),
                'delivery_type' => $request->input('delivery_type'),
                'delivery_address' => $request->input('delivery_address') ?? '',
                'n_post_city' => $request->input('n_post_city') ?? '',
                'n_post_office' => $request->input('n_post_office') ?? '',
                'order_status' => $request->input('status'),
                'updated_at' => Carbon::now(),
                'total_price' => $total_price
            ]);

        DB::table('order_products')->where('order_id', '=', $id)->delete();
        DB::table('order_products')->insert($query);

        return redirect()->back();

    }
}
