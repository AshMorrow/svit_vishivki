<?php

namespace App\Http\Controllers;

use App\Helpers\Options;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Use for get product data form SQL
     * @param $path
     */
    private function getProductData($path){

        if(!$path) return;

        $product = (array)DB::table('products AS p')
            ->select(DB::raw('p.*, GROUP_CONCAT(DISTINCT pc.cv_id) AS char_id'))
            ->leftJoin('product_options AS pc', 'p.id', '=', 'pc.p_id')
            ->where('url', '=', $path)
            ->get()
            ->first();

        $options = [];
        if($product['char_id']) {
            $options = Options::getValues($product['char_id']);
        }
        return ['product' => $product, 'characteristics' => $options];
    }

    public function show($path){

        $data = $this->getProductData($path);
        $product = $data['product'];
        $characteristics = $data['characteristics'];


        // getting images for product gallery
        $galleryFullImages = Storage::drive('public')->allFiles('/productImages/full/'.$product['id']);
        $galleryThumbImages = Storage::drive('public')->allFiles('/productImages/thumbs/'.$product['id']);

        if(!$galleryThumbImages && !$galleryFullImages){
            $galleryFullImages = ['productImages/full/errors/no-image.jpg'];
            $galleryThumbImages = ['productImages/thumbs/errors/no-image.jpg'];
        }elseif(count($galleryThumbImages) < count($galleryFullImages)){
            foreach ($galleryFullImages as $index => $path){
                if(isset($galleryThumbImages[$index])){

                }else{
                    $galleryThumbImages[$index] = $path;
                }
            }
        }else if(count($galleryThumbImages) > count($galleryFullImages)){
            foreach ($galleryThumbImages as $index => $path){
                if(!isset($galleryFullImages[$index])){
                    $galleryFullImages[$index] = 'productImages/full/errors/no-image.jpg';
                }
            }
        }

        return view('pages.productPage', [
            'product' => $product,
            'characteristics' => $characteristics,
            'galleryFullImages' => $galleryFullImages,
            'galleryThumbImages' => $galleryThumbImages,
            'lan' => App::getLocale(),
        ]);

    }
}
