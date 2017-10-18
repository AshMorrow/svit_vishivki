<?php
namespace App\Helpers;


class Categories
{
    public static function formTree($mess){
        $tree = array();
        foreach ($mess as $value) {
            $tree[$value->parent_id][] = $value;
        }
        return $tree;
    }

}