<?php

namespace App\Helpes\Facades;
use Illuminate\Support\Facades\Facade;

class Categories extends Facade
{

    protected static function getFacadeAccessor(){
        return 'categories';
    }

}