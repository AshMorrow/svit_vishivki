<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Lang;

class Order{

    public static function getDeliveryStatus($id){
        $status = [Lang::get()];
    }

}