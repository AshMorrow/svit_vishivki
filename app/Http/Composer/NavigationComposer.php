<?php

namespace App\Http\Composer;


use App\Main_menu;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Helpers\Categories;

class NavigationComposer
{
    public function compose(View $view)
    {
        $menu_data = Main_menu::allCategories();
        $tree = Categories::formTree($menu_data);
        
        return $view->with('cats', $tree);
    }

}