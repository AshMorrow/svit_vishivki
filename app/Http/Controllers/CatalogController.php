<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{

    /**
     * Get categories id from url
     * @param $path
     * @return array
     */
    private function getCategoryIds($path)
    {
        $selected_category = explode('/', $path);
        $categories = DB::table('main_menu')->select('*')->get()->toArray();

        $categories_ids = [];
        $last_parent_id = 0;
        for ($i = 0; $i < count($selected_category); $i++) {
            if ($i == 0) {
                foreach ($categories as $v) {
                    if ($v->url == $selected_category[$i]) {
                        $last_parent_id = $v->id;
                        $categories_ids[] = $v->id;
                    }
                }
            } else {
                foreach ($categories as $v) {
                    if ($v->parent_id == $last_parent_id && $v->url == $selected_category[$i]) {
                        $last_parent_id = $v->id;
                        $categories_ids[] = $v->id;
                    }
                }
            }
        }

        return $categories_ids;
    }

    /**
     *  Prepare filer data to query
     *
     * @param $request
     * @return array
     */
    private function productFilter($request)
    {

        $filter = [];

        /*
         *  Price filter
         *  get and validate data
         */

        $price = $request->get('price');
        if (isset($price['price_from']) && isset($price['price_to'])) {
            $filter[] = ['price','>=',$price['price_from']];
            $filter[] = ['price','<=',$price['price_to']];
        }

        /*
         *  Color filter
         *
         */

        return $filter;
    }

    public function show($path, Request $request)
    {
       if (isset($_GET) && $_GET) {

            $filer = $this->productFilter($request);

        }
        $categories_ids = $this->getCategoryIds($path);

       $products = new Products();

        $products = $products::where([
            ['category_id', '=', end($categories_ids)],
            ['is_active', '=', '1']
        ]);

        $max_price = $products->max('price');

        if(isset($filer)){
            $products = new Products();
            $filer[] = ['category_id', '=', end($categories_ids)];
            $filer[] = ['is_active', '=', '1'];

            $products = $products::where($filer);

        }

        $products = $products->get();

        return view('pages/catalog', ['products_data' => $products, 'max_price' => $max_price]);

    }
}
