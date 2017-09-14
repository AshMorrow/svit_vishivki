<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class Options{

    public static function getValues($optionsIds){

        if(!$optionsIds && is_string($optionsIds)) return;

        $options = DB::table('characteristics AS c')
            ->select(DB::raw('
                c.name_ru,
                c.name_ua, 
                c.type,
                GROUP_CONCAT(DISTINCT cv.id) AS char_values_id, 
                GROUP_CONCAT(DISTINCT cv.value) AS char_values')
            )
            ->leftJoin('characteristic_value AS cv', 'cv.c_id', '=', 'c.id')
            ->whereIn('cv.id',explode(',', $optionsIds))
            ->groupBy('c.id')
            ->get()->toArray();
        return $options;
    }
}