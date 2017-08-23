<?php
namespace App\Http\Composer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProductFilterComposer
{

    private function getFilterCharacteristics(){
        DB::select('SELECT * FROM chara');
    }

    public function compose(View $view){


        return $view->with('d','');
    }
}