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
            'category_id' => 'required'
        ]);

        $lastId = DB::table('products')->insertGetId([
            'name_ru' => $request->get('name_ru'),
            'name_ua' => $request->get('name_ua'),
            'description_ru' => $request->get('description_ru'),
            'description_ua' => $request->get('description_ua'),
            'vendor_code' => $request->get('vendor_code'),
            'is_new' => $request->get('is_new')?? 0,
            'is_active' => $request->get('is_active')?? 0,
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id')
        ]);

//        dd($lastId);
        $url = translit($request->get('name_ru')).'-'.$lastId;

        DB::table('products')->where([['id', '=', $lastId]])->update(['url' => $url]);


        redirect()->back();

    }
}
