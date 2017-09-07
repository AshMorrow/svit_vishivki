<?php

namespace App\Http\Controllers;

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

//        dd(DB::select('
//         Select *, GROUP_CONCAT(DISTINCT pc.p_id ORDER BY pc.p_id ASC SEPARATOR \', \') AS books From products AS p
//          LEFT JOIN product_characteristics AS pc ON pc.p_id = p.id
//          LEFT JOIN characteristic_value AS cv ON cv.c_id = pc.c_id
//          GROUP BY p.id
//        '));
       if (isset($_GET) && $_GET) {

            $filer = $this->productFilter($request);

        }
        $categories_ids = $this->getCategoryIds($path);


        if(isset($filer)){
            $filer[] = ['p.category_id', '=', end($categories_ids)];
            $filer[] = ['p.is_active', '=', '1'];

            $products = DB::table('products AS p')
                ->select('*')
                ->where(
                    $filer
                )
                ->get()->toArray();

        }else{
            $products = DB::table('products AS p')
                ->select('*')
                ->where([
                    ['p.category_id', '=', end($categories_ids)],
                    ['p.is_active', '=', '1']
                ])
                ->get()->toArray();

        }

        return view('pages/catalog', ['products_data' => $products]);

    }
}
