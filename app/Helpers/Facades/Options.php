<?php
namespace App\Helpes\Facades;

use Illuminate\Support\Facades\Facade;

class Options extends Facade{



    protected static function getFacadeAccessor(){
        return 'options';
    }

}
