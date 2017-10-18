<?php

namespace App\Http\Controllers;

use App\Helpers\Categories;
use App\Helpers\Options;
use App\Main_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductsController extends Controller
{
    public function getProductsList(Request $request){

        $filter = [];
        $activity = $request->get('activity');

        switch ($activity){
            case 'active': $activity = 1; break;
            case 'no_active': $activity = 0; break;
            default: $activity = null;
        }

        $search = $request->get('search');
        if($activity !== null){
            $search = '%'.$search.'%';
            $filter = [
                ['vendor_code', 'like', $search],
                ['is_active', '=', $activity]
            ];
        }elseif($activity === null){
            $search = '%'.$search.'%';
            $filter = [
                ['vendor_code', 'like', $search]
            ];
        }

        $products = DB::table('products')->select('id','name_ru', 'vendor_code', 'price')->where($filter)->paginate(10);

        return view('admin.productsList', [
            'products' => $products
        ]);
    }

    public function createPage(){

        $mesh = Main_menu::allCategories();
        $categories = Categories::formTree($mesh);

        $options = Options::getAllOptions();

        return view('admin.productCreate', [
            'categories' => $categories,
            'options' => $options
        ]);
    }

    public function create(Request $request){

        $this->validate($request,[
            'name_ru' => 'required',
            'name_ua' => 'required',
            'vendor_code' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);



    }
}
