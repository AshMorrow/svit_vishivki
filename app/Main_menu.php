<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main_menu extends Model
{
    protected $table = 'main_menu';

    public static function allCategories(){
        return self::all();
    }
}
