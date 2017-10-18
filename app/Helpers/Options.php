<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class Options{

    protected static function toArray($options){

        foreach($options as $option){
            $option->char_values_id = explode(',',$option->char_values_id);
            $option->char_values = explode(',',$option->char_values);
        }

    }

    public static function getValues($optionsIds, $toArray = false){

        if(!$optionsIds && is_string($optionsIds)) return;

        $options = DB::table('options AS o')
            ->select(DB::raw('
                o.name_ru,
                o.name_ua, 
                o.type,
                GROUP_CONCAT(DISTINCT ov.id) AS char_values_id, 
                GROUP_CONCAT(DISTINCT ov.value) AS char_values')
            )
            ->leftJoin('options_value AS ov', 'ov.c_id', '=', 'o.id')
            ->whereIn('ov.id',explode(',', $optionsIds))
            ->groupBy('o.id')
            ->get()->toArray();

        if($toArray) {
            self::toArray($options);
        }

        return $options;
    }

    public static function getAllOptions($toArray = false){

        $options = DB::table('options AS o')
            ->select(DB::raw('
                o.name_ru,
                o.name_ua, 
                o.type,
                GROUP_CONCAT(DISTINCT ov.id) AS char_values_id, 
                GROUP_CONCAT(DISTINCT ov.value) AS char_values')
            )
            ->leftJoin('options_value AS ov', 'ov.c_id', '=', 'o.id')
            ->groupBy('o.id')
            ->get()->toArray();

        if($toArray) {
            self::toArray($options);
        }

        return $options;
    }
}