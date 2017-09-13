<?php
/**
 * Created by PhpStorm.
 * User: Mefisto
 * Date: 6/29/2017
 * Time: 2:46 PM
 */

namespace App\Http\Composer;

use Illuminate\View\View;

class SmallCartComposer
{
    public function compose(View $view)
    {
        if (isset($_COOKIE['productInCart']) && $_COOKIE['productInCart']) {
            $products = json_decode($_COOKIE['productInCart'])->products;
            return $view->with('products',$products);
        }
    }
}