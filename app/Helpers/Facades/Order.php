<?php
namespace App\Helpes\Facades;

use Illuminate\Support\Facades\Facade;

class Order extends Facade{



    protected static function getFacadeAccessor(){
        return 'order';
    }

}
